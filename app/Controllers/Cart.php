<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Libraries\EmailService;
use CodeIgniter\HTTP\ResponseInterface;

class Cart extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Shopping Cart',
        ];

        return view('layout/header', $data)
            . view('cart/index', $data)
            . view('layout/footer', $data);
    }

    public function add()
    {
        // Handle adding items to cart via POST
        $item = $this->request->getPost();
        
        // Get existing cart from localStorage (handled by JavaScript)
        // This is just a placeholder for future server-side cart handling
        
        return $this->response->setJSON(['success' => true]);
    }

    public function remove()
    {
        // Handle removing items from cart via POST
        $itemId = $this->request->getPost('item_id');
        
        // This is just a placeholder for future server-side cart handling
        
        return $this->response->setJSON(['success' => true]);
    }

    public function update()
    {
        // Handle updating cart quantities via POST
        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');
        
        // This is just a placeholder for future server-side cart handling
        
        return $this->response->setJSON(['success' => true]);
    }

    /**
     * Process order submission
     */
    public function processOrder()
    {
        $orderModel = new OrderModel();
        $emailService = new EmailService();

        // Get order data from POST
        $customerEmail = $this->request->getPost('email');
        $customerPhone = $this->request->getPost('phone');
        $customerName = $this->request->getPost('name') ?? '';
        $orderData = $this->request->getPost('order_data');
        $totalAmount = $this->request->getPost('total_amount');
        $emergencyMode = $this->request->getPost('emergency_mode') === 'true';

        // Validate required fields
        if (empty($customerEmail) || empty($customerPhone) || empty($orderData) || empty($totalAmount)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Missing required fields'
            ]);
        }

        try {
            // Parse order data
            $orderItems = json_decode($orderData, true);
            if (!$orderItems) {
                throw new \Exception('Invalid order data');
            }

            // Prepare order data for database
            $orderDataForDb = [
                'customer_email' => $customerEmail,
                'customer_phone' => $customerPhone,
                'customer_name' => $customerName,
                'order_data' => $orderData,
                'total' => $totalAmount,
                'emergency_mode' => $emergencyMode ? 1 : 0,
                'status' => 'pending'
            ];

            // Generate order number manually
            $orderNumber = 'GC-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $orderDataForDb['order_number'] = $orderNumber;
            
            // Save order to database
            $orderId = $orderModel->insert($orderDataForDb);
            
            if (!$orderId) {
                $errors = $orderModel->errors();
                log_message('error', 'Order insert failed: ' . json_encode($errors));
                throw new \Exception('Failed to save order: ' . implode(', ', $errors));
            }

            // Get the saved order with generated order number
            $savedOrder = $orderModel->find($orderId);
            
            // Prepare data for emails
            $emailData = [
                'order_number' => $savedOrder['order_number'],
                'customer_email' => $customerEmail,
                'customer_phone' => $customerPhone,
                'customer_name' => $customerName,
                'order_items' => $orderItems,
                'total' => $totalAmount,
                'emergency_mode' => $emergencyMode
            ];

            // Send emails
            $customerEmailSent = $emailService->sendOrderConfirmation($emailData);
            $ownerEmailSent = $emailService->sendOrderNotification($emailData);

            return $this->response->setJSON([
                'success' => true,
                'order_number' => $savedOrder['order_number'],
                'message' => 'Order submitted successfully! Check your email for confirmation.'
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Order processing failed: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to process order. Please try again.'
            ]);
        }
    }
}
