<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Golf Club Builders - Precision. Performance. Every Swing. Professional club building, fitting, and simulator services in Chambersburg, PA">
    <title><?= isset($title) ? esc($title) . ' - Golf Club Builders' : 'Golf Club Builders - Precision. Performance. Every Swing.' ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.min.css?v=2.6') ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/webp" href="<?= base_url('images/logo-small.webp') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('images/logo-small.png') ?>">
</head>
<body>
    <header class="header">
        <nav class="nav-container">
            <a href="<?= base_url('/') ?>" class="logo">
                <picture>
                    <source srcset="<?= base_url('images/logo-banner.webp') ?>" type="image/webp">
                    <img src="<?= base_url('images/logo-banner.png') ?>" alt="Golf Club Builders" loading="eager" style="height: 80px;">
                </picture>
            </a>
            
            <a href="<?= base_url('/cart') ?>" class="cart-button" id="cart-button">
                <span class="cart-icon">🛒</span>
                <span class="cart-count" id="cart-count" style="display: none;"></span>
            </a>
            
            <ul class="nav-menu">
                <li><a href="<?= base_url('/') ?>" class="nav-link">Home</a></li>
                <li><a href="<?= base_url('/custom-club-building') ?>" class="nav-link">Club Builds</a></li>
                <li><a href="<?= base_url('/fitting') ?>" class="nav-link">Fitting</a></li>
                <li><a href="<?= base_url('/simulator') ?>" class="nav-link">Simulator</a></li>
                <li><a href="<?= base_url('/blog') ?>" class="nav-link">Blog</a></li>
                <li><a href="<?= base_url('/contact') ?>" class="nav-link">Contact</a></li>
                <?php 
                // Temporarily disabled auth for public site
                // Uncomment when auth is properly configured on live server
                /*
                if (function_exists('auth') && auth()->loggedIn()): 
                    $user = auth()->user();
                    $isAdmin = isset($user->is_admin) && $user->is_admin == 1;
                    if ($isAdmin): ?>
                        <li><a href="<?= base_url('/toggle-view') ?>" class="btn btn-primary" style="margin-right: 10px;">
                            🔄 Switch to Admin View
                        </a></li>
                    <?php else: ?>
                        <li><a href="<?= base_url('/account') ?>" class="nav-link">My Account</a></li>
                    <?php endif; ?>
                    <li><a href="<?= base_url('/logout') ?>" class="btn btn-outline">Logout</a></li>
                <?php elseif (function_exists('auth')): ?>
                    <li><a href="<?= base_url('/login') ?>" class="btn btn-outline">Login</a></li>
                <?php endif;
                */
                ?>
            </ul>
            
            <button class="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </header>
    
    <main>

