<?php

namespace App\Libraries;

use CodeIgniter\Email\Email;
use CodeIgniter\Config\Services;

class EmailService
{
    protected $email;
    protected $config;

    public function __construct()
    {
        $this->email = Services::email();
        $this->config = config('Email');
    }

    /**
     * Send order confirmation to customer
     */
    public function sendOrderConfirmation($orderData)
    {
        $this->email->setFrom('noreply@golfclub-builders.com', 'Golf Club Builders');
        $this->email->setTo($orderData['customer_email']);
        $this->email->setSubject('Order Confirmation - ' . $orderData['order_number']);
        
        $message = $this->buildCustomerEmail($orderData);
        $this->email->setMessage($message);
        $this->email->setMailType('html');
        
        return $this->email->send();
    }

    /**
     * Send order notification to business owner
     */
    public function sendOrderNotification($orderData)
    {
        $this->email->setFrom('noreply@golfclub-builders.com', 'Golf Club Builders');
        $this->email->setTo('Daniel@Golfclub-builders.com'); // Your email
        $this->email->setSubject('New Order Received - ' . $orderData['order_number']);
        
        $message = $this->buildOwnerEmail($orderData);
        $this->email->setMessage($message);
        $this->email->setMailType('html');
        
        return $this->email->send();
    }

    /**
     * Build customer confirmation email
     */
    private function buildCustomerEmail($orderData)
    {
        $emergencyNotice = $orderData['emergency_mode'] ? 
            '<div style="background: #ff6b6b; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                <h3 style="margin: 0 0 0.5rem 0;">🚨 SAME-DAY SERVICE REQUESTED</h3>
                <p style="margin: 0; font-weight: 600;">You MUST call (717) 387-1643 to confirm availability for same-day service!</p>
            </div>' : '';

        $orderItems = '';
        foreach ($orderData['order_items'] as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $orderItems .= '<tr>
                <td style="padding: 0.5rem; border-bottom: 1px solid #eee;">' . $item['name'] . '</td>
                <td style="padding: 0.5rem; border-bottom: 1px solid #eee; text-align: center;">' . $item['quantity'] . '</td>
                <td style="padding: 0.5rem; border-bottom: 1px solid #eee; text-align: right;">$' . number_format($item['price'], 2) . '</td>
                <td style="padding: 0.5rem; border-bottom: 1px solid #eee; text-align: right;">$' . number_format($itemTotal, 2) . '</td>
            </tr>';
        }

        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Order Confirmation</title>
        </head>
        <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="color: #0b6e4f; margin-bottom: 0.5rem;">Golf Club Builders</h1>
                <p style="color: #666; margin: 0;">Professional Club Building & Fitting Services</p>
            </div>
            
            ' . $emergencyNotice . '
            
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <h2 style="color: #0b6e4f; margin-top: 0;">Order Confirmation</h2>
                <p><strong>Order Number:</strong> ' . $orderData['order_number'] . '</p>
                <p><strong>Order Date:</strong> ' . date('F j, Y \a\t g:i A') . '</p>
                <p><strong>Total Amount:</strong> $' . number_format($orderData['total'], 2) . '</p>
            </div>
            
            <h3 style="color: #0b6e4f;">Order Details</h3>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 2rem;">
                <thead>
                    <tr style="background: #0b6e4f; color: white;">
                        <th style="padding: 0.75rem; text-align: left;">Service</th>
                        <th style="padding: 0.75rem; text-align: center;">Qty</th>
                        <th style="padding: 0.75rem; text-align: right;">Price</th>
                        <th style="padding: 0.75rem; text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    ' . $orderItems . '
                </tbody>
            </table>
            
            <div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                <h3 style="color: #856404; margin-top: 0;">📞 Next Steps</h3>
                <p style="margin: 0; color: #856404;"><strong>Please call (717) 387-1643 to schedule your appointment.</strong></p>
                <p style="margin: 0.5rem 0 0 0; color: #856404;">Payment is due upon arrival. We do not accept online payments at this time.</p>
            </div>
            
            <div style="text-align: center; margin-top: 2rem;">
                <p style="color: #666; font-size: 0.9rem;">Thank you for choosing Golf Club Builders!</p>
                <p style="color: #666; font-size: 0.9rem;">Daniel@Golfclub-builders.com | (717) 387-1643</p>
            </div>
        </body>
        </html>';
    }

    /**
     * Build owner notification email
     */
    private function buildOwnerEmail($orderData)
    {
        $emergencyNotice = $orderData['emergency_mode'] ? 
            '<div style="background: #ff6b6b; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                <h3 style="margin: 0 0 0.5rem 0;">🚨 SAME-DAY SERVICE REQUESTED</h3>
                <p style="margin: 0; font-weight: 600;">Customer needs same-day service - call immediately!</p>
            </div>' : '';

        $orderItems = '';
        foreach ($orderData['order_items'] as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $orderItems .= '<tr>
                <td style="padding: 0.5rem; border-bottom: 1px solid #eee;">' . $item['name'] . '</td>
                <td style="padding: 0.5rem; border-bottom: 1px solid #eee; text-align: center;">' . $item['quantity'] . '</td>
                <td style="padding: 0.5rem; border-bottom: 1px solid #eee; text-align: right;">$' . number_format($item['price'], 2) . '</td>
                <td style="padding: 0.5rem; border-bottom: 1px solid #eee; text-align: right;">$' . number_format($itemTotal, 2) . '</td>
            </tr>';
        }

        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>New Order Notification</title>
        </head>
        <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="color: #0b6e4f; margin-bottom: 0.5rem;">New Order Received</h1>
                <p style="color: #666; margin: 0;">Golf Club Builders</p>
            </div>
            
            ' . $emergencyNotice . '
            
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <h2 style="color: #0b6e4f; margin-top: 0;">Order Information</h2>
                <p><strong>Order Number:</strong> ' . $orderData['order_number'] . '</p>
                <p><strong>Customer Email:</strong> ' . $orderData['customer_email'] . '</p>
                <p><strong>Customer Phone:</strong> ' . $orderData['customer_phone'] . '</p>
                <p><strong>Order Date:</strong> ' . date('F j, Y \a\t g:i A') . '</p>
                <p><strong>Total Amount:</strong> $' . number_format($orderData['total'], 2) . '</p>
            </div>
            
            <h3 style="color: #0b6e4f;">Order Details</h3>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 2rem;">
                <thead>
                    <tr style="background: #0b6e4f; color: white;">
                        <th style="padding: 0.75rem; text-align: left;">Service</th>
                        <th style="padding: 0.75rem; text-align: center;">Qty</th>
                        <th style="padding: 0.75rem; text-align: right;">Price</th>
                        <th style="padding: 0.75rem; text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    ' . $orderItems . '
                </tbody>
            </table>
            
            <div style="background: #d1ecf1; border: 1px solid #bee5eb; padding: 1rem; border-radius: 8px;">
                <h3 style="color: #0c5460; margin-top: 0;">Action Required</h3>
                <p style="margin: 0; color: #0c5460;">Contact the customer to schedule their appointment.</p>
            </div>
        </body>
        </html>';
    }
}
