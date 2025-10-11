<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlockedDateModel;
use App\Models\BookingModel;

class Calendar extends BaseController
{
    protected $blockedDateModel;
    protected $bookingModel;
    
    public function __construct()
    {
        $this->blockedDateModel = new BlockedDateModel();
        $this->bookingModel = new BookingModel();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        // Get all blocked dates
        $blockedDates = $this->blockedDateModel->orderBy('date', 'ASC')->findAll();
        
        // Get bookings for calendar view
        $bookings = $this->bookingModel
            ->where('booking_date >=', date('Y-m-d'))
            ->orderBy('booking_date', 'ASC')
            ->limit(100)
            ->findAll();
        
        $data = [
            'title' => 'Calendar Management',
            'blockedDates' => $blockedDates,
            'bookings' => $bookings
        ];
        
        return view('admin/layout/header', $data)
             . view('admin/calendar/index', $data)
             . view('admin/layout/footer', $data);
    }
    
    public function blockDate()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin/calendar');
        }
        
        $blockData = [
            'date' => $this->request->getPost('date'),
            'start_time' => $this->request->getPost('start_time') ?: null,
            'end_time' => $this->request->getPost('end_time') ?: null,
            'reason' => $this->request->getPost('reason'),
            'notes' => $this->request->getPost('notes') ?: null,
            'is_recurring' => $this->request->getPost('is_recurring') ? 1 : 0,
            'recurrence_pattern' => $this->request->getPost('recurrence_pattern') ?: null,
            'created_by_admin_id' => 1
        ];
        
        // Basic validation
        if (empty($blockData['date']) || empty($blockData['reason'])) {
            return redirect()->back()->with('error', 'Date and Reason are required!');
        }
        
        // Insert into database
        try {
            $result = $this->blockedDateModel->insert($blockData);
            
            if ($result) {
                return redirect()->to('/admin/calendar')->with('success', 'Date ' . $blockData['date'] . ' blocked successfully!');
            } else {
                $errors = $this->blockedDateModel->errors();
                return redirect()->back()->with('error', 'Database error: ' . json_encode($errors));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
        }
    }
    
    public function unblockDate()
    {
        if ($this->request->getMethod() === 'post') {
            $id = $this->request->getPost('blocked_date_id');
            
            if ($this->blockedDateModel->delete($id)) {
                return redirect()->to('/admin/calendar')->with('success', 'Date unblocked successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to unblock date.');
            }
        }
        
        return redirect()->to('/admin/calendar');
    }
}

