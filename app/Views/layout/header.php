<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Golf Builders - AI Assisted Club Fittings and Professional Regripping Services">
    <title><?= isset($title) ? esc($title) . ' - Golf Builders' : 'Golf Builders - AI Assisted Club Fittings' ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('images/logo-small.png') ?>">
</head>
<body>
    <header class="header">
        <nav class="nav-container">
            <a href="<?= base_url('/') ?>" class="logo">
                <img src="<?= base_url('images/logo-banner.png') ?>" alt="Golf Club Builders" style="height: 60px; width: auto;">
            </a>
            
            <ul class="nav-menu">
                <li><a href="<?= base_url('/') ?>" class="nav-link">Home</a></li>
                <li><a href="<?= base_url('/services') ?>" class="nav-link">Services</a></li>
                <li><a href="<?= base_url('/shop') ?>" class="nav-link">Shop</a></li>
                <li><a href="<?= base_url('/booking') ?>" class="nav-link">Book Appointment</a></li>
                <li><a href="<?= base_url('/about') ?>" class="nav-link">About</a></li>
                <li><a href="<?= base_url('/contact') ?>" class="nav-link">Contact</a></li>
                <?php if (session()->get('isLoggedIn')): ?>
                    <?php if (session()->get('role') === 'admin'): ?>
                        <li><a href="<?= base_url('/admin') ?>" class="nav-link">Admin</a></li>
                    <?php else: ?>
                        <li><a href="<?= base_url('/account') ?>" class="nav-link">My Account</a></li>
                    <?php endif; ?>
                    <li><a href="<?= base_url('/logout') ?>" class="btn btn-outline">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?= base_url('/login') ?>" class="btn btn-outline">Login</a></li>
                <?php endif; ?>
            </ul>
            
            <button class="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </header>
    
    <main>

