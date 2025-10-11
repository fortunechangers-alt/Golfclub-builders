<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\BookingModel;
use App\Models\BlockedDateModel;
use App\Models\BusinessHourModel;
use App\Models\AvailableTimeSlotModel;

class Booking extends BaseController
{
    protected $serviceModel;
    protected $bookingModel;
    protected $blockedDateModel;
    protected $businessHourModel;
    protected $availableSlotModel;
    
    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->bookingModel = new BookingModel();
        $this->blockedDateModel = new BlockedDateModel();
        $this->businessHourModel = new BusinessHourModel();
        $this->availableSlotModel = new AvailableTimeSlotModel();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        $data = [
            'title' => 'Book Appointment',
            'services' => $this->serviceModel->where('is_active', 1)->findAll(),
            'additionalScripts' => view('booking/booking_script')
        ];
        
        return view('layout/header', $data)
             . view('booking/index', $data)
             . view('layout/footer', $data);
    }
    
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'service_id' => 'required|integer',
                'booking_date' => 'required|valid_date',
                'start_time' => 'required',
                'customer_name' => 'required|min_length[3]',
                'customer_email' => 'required|valid_email',
                'customer_phone' => 'required|min_length[10]'
            ];
            
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            
            $serviceId = $this->request->getPost('service_id');
            $service = $this->serviceModel->find($serviceId);
            
            if (!$service) {
                return redirect()->back()->with('error', 'Service not found.');
            }
            
            // Calculate end time based on service duration
            $startTime = $this->request->getPost('start_time');
            $endTime = date('H:i:s', strtotime($startTime) + ($service['duration'] * 60));
            
            // Generate unique booking reference
            $bookingReference = 'GB-' . strtoupper(uniqid());
            
            $bookingData = [
                'user_id' => session()->get('user_id'),
                'service_id' => $serviceId,
                'booking_reference' => $bookingReference,
                'booking_date' => $this->request->getPost('booking_date'),
                'start_time' => $startTime,
                'end_time' => $endTime,
                'customer_name' => $this->request->getPost('customer_name'),
                'customer_email' => $this->request->getPost('customer_email'),
                'customer_phone' => $this->request->getPost('customer_phone'),
                'special_requests' => $this->request->getPost('special_requests'),
                'status' => 'pending'
            ];
            
            if ($this->bookingModel->insert($bookingData)) {
                // TODO: Send confirmation email
                return redirect()->to('/booking/confirmation/' . $bookingReference)
                    ->with('success', 'Booking created successfully!');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to create booking.');
            }
        }
        
        return redirect()->to('/booking');
    }
    
    public function confirmation($reference = null)
    {
        if (!$reference) {
            return redirect()->to('/booking');
        }
        
        $booking = $this->bookingModel->where('booking_reference', $reference)->first();
        
        if (!$booking) {
            return redirect()->to('/booking')->with('error', 'Booking not found.');
        }
        
        $service = $this->serviceModel->find($booking['service_id']);
        
        $data = [
            'title' => 'Booking Confirmation',
            'booking' => $booking,
            'service' => $service
        ];
        
        return view('layout/header', $data)
             . view('booking/confirmation', $data)
             . view('layout/footer', $data);
    }
    
    public function checkAvailability()
    {
        $date = $this->request->getGet('date');
        $serviceId = $this->request->getGet('service_id');
        
        if (!$date || !$serviceId) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Missing required parameters'
            ]);
        }
        
        $service = $this->serviceModel->find($serviceId);
        
        if (!$service) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Service not found'
            ]);
        }
        
        // SOFT OPENING MODE: Check for admin-opened available slots FIRST
        $availableSlots = $this->availableSlotModel->getAvailableSlotsForDate($date, $serviceId);
        
        // If there are available slots created by admin, ONLY show those
        if (!empty($availableSlots)) {
            $slots = [];
            
            foreach ($availableSlots as $slot) {
                // Check if slot is already booked
                $isBooked = $slot['current_bookings'] >= $slot['max_bookings'];
                
                $slots[] = [
                    'time' => date('g:i A', strtotime($slot['start_time'])),
                    'value' => $slot['start_time'],
                    'available' => !$isBooked && $slot['is_active']
                ];
            }
            
            return $this->response->setJSON([
                'status' => 'success',
                'slots' => $slots,
                'mode' => 'soft_opening' // Indicate this is controlled availability
            ]);
        }
        
        // If NO available slots exist, return empty (all times are blocked by default for soft opening)
        return $this->response->setJSON([
            'status' => 'success',
            'slots' => [],
            'message' => 'No time slots are available for this date yet. Please check back later!',
            'mode' => 'soft_opening'
        ]);
    }
    
    private function generateTimeSlots($openTime, $closeTime, $duration, $existingBookings)
    {
        $slots = [];
        $interval = 30; // 30-minute intervals
        
        $start = strtotime($openTime);
        $end = strtotime($closeTime);
        $slotDuration = $duration * 60; // Convert to seconds
        
        while ($start + $slotDuration <= $end) {
            $slotTime = date('H:i:s', $start);
            $slotEndTime = date('H:i:s', $start + $slotDuration);
            
            // Check if slot overlaps with existing bookings
            $available = true;
            foreach ($existingBookings as $booking) {
                $bookingStart = strtotime($booking['start_time']);
                $bookingEnd = strtotime($booking['end_time']);
                
                if (($start >= $bookingStart && $start < $bookingEnd) ||
                    ($start + $slotDuration > $bookingStart && $start + $slotDuration <= $bookingEnd) ||
                    ($start <= $bookingStart && $start + $slotDuration >= $bookingEnd)) {
                    $available = false;
                    break;
                }
            }
            
            $slots[] = [
                'time' => date('g:i A', $start),
                'value' => $slotTime,
                'available' => $available
            ];
            
            $start += $interval * 60; // Move to next interval
        }
        
        return $slots;
    }
}
