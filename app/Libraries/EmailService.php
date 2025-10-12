<?php

namespace App\Libraries;

class EmailService
{
    protected $apiKey;
    protected $fromEmail;
    protected $fromName;

    public function __construct()
    {
        // Get SendGrid API Key from config
        $config = config('SendGrid');
        $this->apiKey = $config->apiKey;
        $this->fromEmail = $config->fromEmail;
        $this->fromName = $config->fromName;
    }

    /**
     * Send order confirmation to customer
     */
    public function sendOrderConfirmation($orderData)
    {
        $to = $orderData['customer_email'];
        $toName = $orderData['customer_name'] ?? '';
        $subject = 'Order Confirmation - ' . $orderData['order_number'];
        $htmlContent = $this->buildCustomerEmail($orderData);
        
        return $this->sendEmail($to, $toName, $subject, $htmlContent);
    }

    /**
     * Send order notification to business owner
     */
    public function sendOrderNotification($orderData)
    {
        $to = 'daniel@golfclub-builders.com';
        $toName = 'Daniel Willis';
        $subject = 'New Order Received - ' . $orderData['order_number'];
        $htmlContent = $this->buildOwnerEmail($orderData);
        
        return $this->sendEmail($to, $toName, $subject, $htmlContent);
    }

    /**
     * Send email via SendGrid API using cURL
     */
    private function sendEmail($to, $toName, $subject, $htmlContent)
    {
        $data = [
            'personalizations' => [
                [
                    'to' => [
                        [
                            'email' => $to,
                            'name' => $toName
                        ]
                    ],
                    'subject' => $subject
                ]
            ],
            'from' => [
                'email' => $this->fromEmail,
                'name' => $this->fromName
            ],
            'content' => [
                [
                    'type' => 'text/html',
                    'value' => $htmlContent
                ]
            ]
        ];

        $ch = curl_init('https://api.sendgrid.com/v3/mail/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        // Log detailed information
        log_message('debug', 'SendGrid attempt - HTTP Code: ' . $httpCode . ', Response: ' . $response);
        
        if ($curlError) {
            log_message('error', 'SendGrid cURL error: ' . $curlError);
            return false;
        }

        if ($httpCode == 202) {
            log_message('info', 'Email sent successfully via SendGrid to: ' . $to);
            return true;
        } else {
            log_message('error', 'SendGrid API error: HTTP ' . $httpCode . ' - Response: ' . $response);
            return false;
        }
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
                <h1 style="color: #0b6e4f; margin-bottom: 0.5rem;">🏌️ Golf Club Builders</h1>
                <p style="color: #666; margin: 0;">Professional Club Building & Fitting Services</p>
            </div>
            
            <div style="background: linear-gradient(135deg, #0b6e4f, #0a5940); color: white; padding: 2rem; border-radius: 12px; text-align: center; margin-bottom: 2rem;">
                <h2 style="color: white; margin: 0 0 1rem 0; font-size: 1.8rem;">🎉 Thank You for Your Order!</h2>
                <p style="color: rgba(255,255,255,0.95); margin: 0; font-size: 1.1rem;">We\'re excited to help you improve your game! Your order has been received and we can\'t wait to get started.</p>
            </div>
            
            ' . $emergencyNotice . '
            
            <div style="background: linear-gradient(135deg, #ffd700, #f4c430); border: 2px solid #d4a017; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; text-align: center;">
                <h3 style="color: #1f2937; margin-top: 0; font-size: 1.5rem;">📞 NEXT STEP: Schedule Your Appointment!</h3>
                <p style="margin: 0 0 1.5rem 0; color: #1f2937; font-size: 1.2rem;"><strong>Please call us at <a href="tel:7173871643" style="color: #0b6e4f; text-decoration: none; font-size: 1.3rem;">(717) 387-1643</a> to book your time slot.</strong></p>
                <p style="margin: 0; color: #374151; font-size: 1.05rem; font-style: italic;">We can\'t wait to help you achieve <strong>Precision. Performance. Every Swing.</strong> 🏌️⛳</p>
            </div>
            
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <h2 style="color: #0b6e4f; margin-top: 0;">Order Confirmation <span style="color: #dc3545; font-weight: 700;">NOT A RECEIPT</span></h2>
                <p><strong>Order Number:</strong> ' . $orderData['order_number'] . '</p>
                <p><strong>Order Date:</strong> ' . date('F j, Y \a\t g:i A') . '</p>
                <div style="background: white; padding: 1rem; border-radius: 6px; border: 2px solid #0b6e4f; margin-top: 1rem;">
                    <p style="margin: 0 0 0.5rem 0;"><strong style="font-size: 1.2rem; color: #0b6e4f;">Estimated Total: $' . number_format($orderData['total'], 2) . '</strong></p>
                    <p style="margin: 0; color: #856404; font-weight: 600;">💳 Payment due upon arrival</p>
                </div>
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
            
            <div style="background: #e7f3ff; border: 1px solid #b3d9ff; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <h3 style="color: #004085; margin-top: 0;">💳 Payment & Pricing Information</h3>
                <p style="margin: 0 0 0.75rem 0; color: #004085;"><strong>This is NOT a receipt.</strong> The amount shown is an estimate based on your selected services.</p>
                <p style="margin: 0 0 0.75rem 0; color: #004085;">Payment is due upon arrival at your appointment. Your final charge may increase or decrease based on:</p>
                <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem; color: #004085;">
                    <li>Additional services requested during your visit</li>
                    <li>Adjustments to quantities or specifications</li>
                    <li>Parts or materials needed for your custom work</li>
                </ul>
                <p style="margin: 1rem 0 0 0; color: #004085; font-style: italic;">We\'ll discuss all work and pricing with you before proceeding to ensure you\'re completely satisfied!</p>
            </div>
            
            <div style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); padding: 2rem; border-radius: 12px; text-align: center; margin-top: 2rem;">
                <h3 style="color: #0b6e4f; margin: 0 0 1rem 0;">We Can\'t Wait to Work With You! 🏆</h3>
                <p style="color: #555; margin-bottom: 1.5rem; font-size: 1.05rem;">Thank you for trusting Golf Club Builders with your equipment needs. We\'re passionate about helping golfers like you play their best golf, and we\'re honored you chose us!</p>
                <p style="color: #666; margin: 0;">Questions? We\'re here to help!</p>
                <p style="color: #0b6e4f; font-weight: 700; font-size: 1.1rem; margin: 0.5rem 0 0 0;">
                    <a href="mailto:daniel@golfclub-builders.com" style="color: #0b6e4f; text-decoration: none;">daniel@golfclub-builders.com</a> | 
                    <a href="tel:7173871643" style="color: #0b6e4f; text-decoration: none;">(717) 387-1643</a>
                </p>
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
                <p><strong>Estimated Total:</strong> $' . number_format($orderData['total'], 2) . '</p>
                ' . (!empty($orderData['preferred_date']) ? '<p><strong>Preferred Date:</strong> ' . $orderData['preferred_date'] . '</p>' : '') . '
            </div>
            
            ' . (!empty($orderData['build_details']) ? '
            <div style="background: #e7f3ff; border: 1px solid #b3d9ff; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <h3 style="color: #004085; margin-top: 0;">📝 Customer Build Details & Special Requests</h3>
                <p style="margin: 0; color: #004085; white-space: pre-wrap;">' . htmlspecialchars($orderData['build_details']) . '</p>
            </div>
            ' : '') . '
            
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
