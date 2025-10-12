<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class Orders extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        
        // Get all orders, newest first
        $orders = $orderModel->orderBy('created_at', 'DESC')->findAll();
        
        // Parse order_data JSON for each order
        foreach ($orders as &$order) {
            if (!empty($order['order_data'])) {
                $order['items'] = json_decode($order['order_data'], true);
            } else {
                $order['items'] = [];
            }
        }
        
        $data = [
            'title' => 'Orders Management',
            'orders' => $orders
        ];

        return view('admin/layout/header', $data)
            . view('admin/orders/index', $data)
            . view('admin/layout/footer', $data);
    }
    
    public function view($id)
    {
        $orderModel = new OrderModel();
        $order = $orderModel->find($id);
        
        if (!$order) {
            return redirect()->to('/admin/orders')->with('error', 'Order not found');
        }
        
        // Parse order data
        if (!empty($order['order_data'])) {
            $order['items'] = json_decode($order['order_data'], true);
        } else {
            $order['items'] = [];
        }
        
        $data = [
            'title' => 'Order Details - ' . $order['order_number'],
            'order' => $order
        ];

        return view('admin/layout/header', $data)
            . view('admin/orders/view', $data)
            . view('admin/layout/footer', $data);
    }
}
