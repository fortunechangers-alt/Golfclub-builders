<?php
/**
 * SIMPLE ONE-CLICK DEPLOYMENT
 * 
 * Upload this to: /home/golfclub/public_html/simple-deploy.php
 * Then visit: https://golfclub-builders.com/simple-deploy.php?key=deploy123
 * 
 * That's it! Your site updates automatically!
 */

// Simple security key
$deploy_key = 'deploy123'; // Change this to something secret

if (!isset($_GET['key']) || $_GET['key'] !== $deploy_key) {
    http_response_code(401);
    die('Unauthorized - Invalid key');
}

// Run deployment commands
$output = [];
$commands = [
    'cd /home/golfclub/public_html',
    'git fetch origin main 2>&1',
    'git reset --hard origin/main 2>&1',
    'chmod -R 755 app 2>&1',
    'chmod -R 775 writable 2>&1'
];

foreach ($commands as $cmd) {
    exec($cmd, $output);
}

// Add success marker
$output[] = '';
$output[] = '=================================';
$output[] = '✅ DEPLOYMENT SUCCESSFUL!';
$output[] = '=================================';
$output[] = 'PHP Version: ' . PHP_VERSION;
$output[] = 'Latest commit pulled from GitHub';
$output[] = 'Permissions set correctly';

// Log the deployment
$log = date('Y-m-d H:i:s') . " - Deployment completed\n";
file_put_contents('deploy.log', $log, FILE_APPEND);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Deployment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .success {
            background: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .output {
            background: #333;
            color: #0f0;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 12px;
            overflow-x: auto;
        }
        h1 { margin: 0 0 10px 0; }
        .button {
            display: inline-block;
            background: #2196F3;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="success">
        <h1>✅ Deployment Successful!</h1>
        <p>Your website has been updated to the latest version from GitHub.</p>
        <p><strong>Timestamp:</strong> <?= date('Y-m-d H:i:s') ?></p>
    </div>
    
    <h2>Deployment Output:</h2>
    <div class="output">
        <?php 
        foreach ($output as $line) {
            echo htmlspecialchars($line) . "\n";
        }
        ?>
    </div>
    
    <a href="/" class="button">← Back to Website</a>
    <a href="?key=<?= $deploy_key ?>" class="button">🔄 Deploy Again</a>
    
    <p style="margin-top: 30px; color: #666; font-size: 14px;">
        <strong>How to use:</strong><br>
        Bookmark this URL: https://golfclub-builders.com/simple-deploy.php?key=<?= $deploy_key ?><br>
        Click the bookmark anytime you want to update your site!
    </p>
</body>
</html>

