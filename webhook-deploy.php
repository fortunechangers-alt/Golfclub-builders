<?php
/**
 * Webhook Deployment Script
 * Place this file in your live server's public_html directory
 * Then set up a webhook in GitHub to call this URL
 */

// Security: Only allow GitHub webhooks
$github_secret = 'YOUR_WEBHOOK_SECRET_HERE'; // Set this in GitHub webhook settings
$headers = getallheaders();
$signature = $headers['X-Hub-Signature-256'] ?? '';

if (!hash_equals('sha256=' . hash_hmac('sha256', file_get_contents('php://input'), $github_secret), $signature)) {
    http_response_code(401);
    die('Unauthorized');
}

// Only deploy on main branch pushes
$payload = json_decode(file_get_contents('php://input'), true);
if ($payload['ref'] !== 'refs/heads/main') {
    die('Not main branch, skipping deployment');
}

// Execute deployment
$output = [];
$return_code = 0;

// Change to your site directory
chdir('/home/golfclub/public_html');

// Run deployment commands
exec('git pull origin main 2>&1', $output, $return_code);
exec('chmod -R 755 app 2>&1', $output, $return_code);
exec('chmod -R 775 writable 2>&1', $output, $return_code);

// Log the deployment
$log_entry = date('Y-m-d H:i:s') . " - Deployment completed\n";
file_put_contents('/home/golfclub/public_html/deploy.log', $log_entry, FILE_APPEND);

// Return success
http_response_code(200);
echo json_encode([
    'status' => 'success',
    'message' => 'Deployment completed',
    'output' => $output,
    'timestamp' => date('Y-m-d H:i:s')
]);
?>
