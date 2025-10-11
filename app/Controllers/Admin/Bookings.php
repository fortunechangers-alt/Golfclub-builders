<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\ServiceModel;

class Bookings extends BaseController
{
    protected $bookingModel;
    protected $serviceModel;
    
    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->serviceModel = new ServiceModel();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        // Get filter parameters
        $status = $this->request->getGet('status');
        $date = $this->request->getGet('date');
        
        $builder = $this->bookingModel;
        
        if ($status) {
            $builder->where('status', $status);
        }
        
        if ($date) {
            $builder->where('booking_date', $date);
        }
        
        $bookings = $builder->orderBy('booking_date', 'DESC')->findAll();
        
        $data = [
            'title' => 'Manage Bookings',
            'bookings' => $bookings,
            'filterStatus' => $status,
            'filterDate' => $date
        ];
        
        return view('admin/layout/header', $data)
             . view('admin/bookings/index', $data)
             . view('admin/layout/footer', $data);
    }
    
    public function view($id)
    {
        $booking = $this->bookingModel->find($id);
        
        if (!$booking) {
            return redirect()->to('/admin/bookings')->with('error', 'Booking not found.');
        }
        
        $service = $this->serviceModel->find($booking['service_id']);
        
        $data = [
            'title' => 'View Booking',
            'booking' => $booking,
            'service' => $service
        ];
        
        return view('admin/layout/header', $data)
             . view('admin/bookings/view', $data)
             . view('admin/layout/footer', $data);
    }
    
    public function updateStatus()
    {
        if ($this->request->getMethod() === 'post') {
            $id = $this->request->getPost('booking_id');
            $status = $this->request->getPost('status');
            $adminNotes = $this->request->getPost('admin_notes');
            
            $updateData = ['status' => $status];
            
            if ($adminNotes) {
                $updateData['admin_notes'] = $adminNotes;
            }
            
            if ($this->bookingModel->update($id, $updateData)) {
                return redirect()->back()->with('success', 'Booking status updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to update booking status.');
            }
        }
        
        return redirect()->to('/admin/bookings');
    }
}

