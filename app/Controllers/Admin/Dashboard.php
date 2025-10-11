<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected $bookingModel;
    protected $orderModel;
    protected $productModel;
    protected $userModel;
    
    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->orderModel = new OrderModel();
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
    }
    
    public function index()
    {
        // Get statistics
        $stats = [
            'total_bookings' => $this->bookingModel->countAll(),
            'pending_bookings' => $this->bookingModel->where('status', 'pending')->countAllResults(),
            'today_bookings' => $this->bookingModel->where('booking_date', date('Y-m-d'))->countAllResults(),
            'total_customers' => $this->userModel->countAll(), // All users for now
        ];
        
        // Get recent bookings
        $recentBookings = $this->bookingModel
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->find();
        
        $data = [
            'title' => 'Dashboard',
            'stats' => $stats,
            'recentBookings' => $recentBookings
        ];
        
        return view('admin/layout/header', $data)
             . view('admin/dashboard/index', $data)
             . view('admin/layout/footer', $data);
    }
}

