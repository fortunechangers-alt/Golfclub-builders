<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AvailableTimeSlotModel;
use App\Models\ServiceModel;
use App\Models\BookingModel;

class AvailableSlots extends BaseController
{
    protected $slotModel;
    protected $serviceModel;
    protected $bookingModel;
    
    public function __construct()
    {
        $this->slotModel = new AvailableTimeSlotModel();
        $this->serviceModel = new ServiceModel();
        $this->bookingModel = new BookingModel();
        helper(['form', 'url']);
    }
    
    /**
     * Display calendar view of available slots
     */
    public function index()
    {
        $month = $this->request->getGet('month') ?? date('Y-m');
        $serviceId = $this->request->getGet('service_id');
        
        // Get all services for the filter
        $services = $this->serviceModel->where('is_active', 1)->findAll();
        
        // Get available slots for the month
        $startDate = $month . '-01';
        $endDate = date('Y-m-t', strtotime($startDate));
        
        $builder = $this->slotModel
            ->where('date >=', $startDate)
            ->where('date <=', $endDate)
            ->orderBy('date', 'ASC')
            ->orderBy('start_time', 'ASC');
        
        if ($serviceId) {
            $builder->where('service_id', $serviceId);
        }
        
        $slots = $builder->findAll();
        
        // Get existing bookings for reference
        $bookings = $this->bookingModel
            ->where('booking_date >=', $startDate)
            ->where('booking_date <=', $endDate)
            ->whereIn('status', ['pending', 'confirmed'])
            ->findAll();
        
        $data = [
            'title' => 'Manage Available Time Slots - Soft Opening',
            'slots' => $slots,
            'services' => $services,
            'month' => $month,
            'serviceId' => $serviceId,
            'bookings' => $bookings
        ];
        
        return view('admin/layout/header', $data)
             . view('admin/available_slots/index', $data)
             . view('admin/layout/footer', $data);
    }
    
    /**
     * Show form to add new available slots
     */
    public function create()
    {
        $services = $this->serviceModel->where('is_active', 1)->findAll();
        
        $data = [
            'title' => 'Open New Time Slots',
            'services' => $services
        ];
        
        return view('admin/layout/header', $data)
             . view('admin/available_slots/create', $data)
             . view('admin/layout/footer', $data);
    }
    
    /**
     * Handle slot creation (can create multiple at once)
     */
    public function store()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin/available-slots/create');
        }
        
        $serviceId = $this->request->getPost('service_id');
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');
        $timeSlots = $this->request->getPost('time_slots'); // Array of times
        $notes = $this->request->getPost('notes');
        
        // Assume admin ID 1 for now (you'll add authentication later)
        $adminId = 1;
        
        $createdCount = 0;
        $errors = [];
        
        // Loop through date range
        $currentDate = strtotime($startDate);
        $endDateTime = strtotime($endDate);
        
        while ($currentDate <= $endDateTime) {
            $dateStr = date('Y-m-d', $currentDate);
            
            // Skip if it's a day we don't want (optional)
            // For now, create slots for all days
            
            foreach ($timeSlots as $timeSlot) {
                // Parse time slot (e.g., "09:00-10:30")
                $times = explode('-', $timeSlot);
                if (count($times) !== 2) {
                    continue;
                }
                
                $startTime = trim($times[0]);
                $endTime = trim($times[1]);
                
                // Check if slot already exists
                $existing = $this->slotModel
                    ->where('date', $dateStr)
                    ->where('start_time', $startTime)
                    ->where('service_id', $serviceId)
                    ->first();
                
                if ($existing) {
                    $errors[] = "Slot already exists for $dateStr at $startTime";
                    continue;
                }
                
                // Create the slot
                $slotData = [
                    'service_id' => $serviceId,
                    'date' => $dateStr,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'max_bookings' => 1,
                    'current_bookings' => 0,
                    'is_active' => true,
                    'notes' => $notes,
                    'created_by_admin_id' => $adminId
                ];
                
                if ($this->slotModel->insert($slotData)) {
                    $createdCount++;
                } else {
                    $errors[] = "Failed to create slot for $dateStr at $startTime";
                }
            }
            
            // Move to next day
            $currentDate = strtotime('+1 day', $currentDate);
        }
        
        if ($createdCount > 0) {
            $message = "Successfully created $createdCount time slot(s)!";
            if (count($errors) > 0) {
                $message .= " (" . count($errors) . " skipped)";
            }
            return redirect()->to('/admin/available-slots')->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'No slots were created. ' . implode(', ', $errors));
        }
    }
    
    /**
     * Toggle slot active status
     */
    public function toggle($id)
    {
        $slot = $this->slotModel->find($id);
        
        if (!$slot) {
            return redirect()->back()->with('error', 'Slot not found.');
        }
        
        $newStatus = !$slot['is_active'];
        
        if ($this->slotModel->update($id, ['is_active' => $newStatus])) {
            $message = $newStatus ? 'Slot activated!' : 'Slot deactivated!';
            return redirect()->back()->with('success', $message);
        }
        
        return redirect()->back()->with('error', 'Failed to update slot.');
    }
    
    /**
     * Delete a slot
     */
    public function delete($id)
    {
        $slot = $this->slotModel->find($id);
        
        if (!$slot) {
            return redirect()->back()->with('error', 'Slot not found.');
        }
        
        // Check if there are bookings for this slot
        $hasBookings = $this->bookingModel
            ->where('booking_date', $slot['date'])
            ->where('start_time', $slot['start_time'])
            ->where('service_id', $slot['service_id'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->first();
        
        if ($hasBookings) {
            return redirect()->back()->with('error', 'Cannot delete slot with existing bookings. Deactivate it instead.');
        }
        
        if ($this->slotModel->delete($id)) {
            return redirect()->back()->with('success', 'Slot deleted successfully!');
        }
        
        return redirect()->back()->with('error', 'Failed to delete slot.');
    }
    
    /**
     * Quick create - opens multiple slots quickly
     */
    public function quickCreate()
    {
        $services = $this->serviceModel->where('is_active', 1)->findAll();
        
        $data = [
            'title' => 'Quick Open Time Slots',
            'services' => $services
        ];
        
        return view('admin/layout/header', $data)
             . view('admin/available_slots/quick_create', $data)
             . view('admin/layout/footer', $data);
    }
}

