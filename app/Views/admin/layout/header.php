<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) . ' - Admin' : 'Admin Panel' ?> - Golf Club Builders</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/webp" href="<?= base_url('images/logo-small.webp') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('images/logo-small.png') ?>">
    
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }
        .admin-sidebar {
            width: 260px;
            background: var(--navy-blue);
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        .admin-main {
            margin-left: 260px;
            flex: 1;
            background: var(--light-gray);
            min-height: 100vh;
            padding: 2rem;
        }
        .admin-header {
            background: white;
            padding: 1.5rem 2rem;
            margin: -2rem -2rem 2rem -2rem;
            box-shadow: 0 2px 10px var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <div style="padding: 0 1.5rem; margin-bottom: 2rem;">
                <a href="<?= base_url('/') ?>" style="color: white; text-decoration: none; display: flex; flex-direction: column; align-items: center;">
                    <picture>
                        <source srcset="<?= base_url('images/logo-small.webp') ?>" type="image/webp">
                        <img src="<?= base_url('images/logo-small.png') ?>" alt="Golf Club Builders" style="width: 60px; height: auto; margin-bottom: 0.75rem;">
                    </picture>
                    <h2 style="color: white; margin: 0; text-align: center;">Golf Club<br><span style="color: var(--golf-green);">Builders</span></h2>
                    <p style="color: rgba(255,255,255,0.6); margin: 0.5rem 0 0 0; font-size: 0.9rem;">Admin Panel</p>
                </a>
            </div>
            
            <ul class="admin-menu">
                <li>
                    <a href="<?= base_url('/admin/dashboard') ?>" class="<?= (uri_string() == 'admin/dashboard' || uri_string() == 'admin') ? 'active' : '' ?>">
                        📊 Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/admin/bookings') ?>" class="<?= strpos(uri_string(), 'admin/bookings') !== false ? 'active' : '' ?>">
                        📅 Bookings
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/admin/calendar') ?>" class="<?= strpos(uri_string(), 'admin/calendar') !== false ? 'active' : '' ?>">
                        🗓️ Calendar Management
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/admin/products') ?>" class="<?= strpos(uri_string(), 'admin/products') !== false ? 'active' : '' ?>">
                        🛍️ Products
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/admin/orders') ?>" class="<?= strpos(uri_string(), 'admin/orders') !== false ? 'active' : '' ?>">
                        📦 Orders
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/admin/business-hours') ?>" class="<?= strpos(uri_string(), 'admin/business-hours') !== false ? 'active' : '' ?>">
                        🕐 Business Hours
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/admin/settings') ?>" class="<?= strpos(uri_string(), 'admin/settings') !== false ? 'active' : '' ?>">
                        ⚙️ Settings
                    </a>
                </li>
                <li style="margin-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem;">
                    <a href="<?= base_url('/') ?>">
                        🏠 View Site
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/logout') ?>">
                        🚪 Logout
                    </a>
                </li>
            </ul>
        </aside>
        
        <main class="admin-main">
            <div class="admin-header">
                <h1 style="margin: 0; color: var(--navy-blue);"><?= isset($title) ? esc($title) : 'Dashboard' ?></h1>
                <div>
                    <span style="color: #666;">Welcome, <strong>Admin</strong></span>
                </div>
            </div>

