<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Frontend Routes
$routes->get('/', 'Home::index');

// Test route (temporary)
$routes->get('/test-block', 'TestBlockDate::index');

// Services
$routes->get('/services', 'Services::index');
$routes->get('/services/(:segment)', 'Services::view/$1');

// Booking
$routes->get('/booking', 'Booking::index');
$routes->post('/booking/create', 'Booking::create');
$routes->get('/booking/confirmation/(:segment)', 'Booking::confirmation/$1');
$routes->get('/booking/checkAvailability', 'Booking::checkAvailability');

// API Routes
$routes->get('/api/available-dates', 'Api\AvailableDates::index');

// Shop
$routes->get('/shop', 'Shop::index');
$routes->get('/shop/(:segment)', 'Shop::view/$1');
$routes->get('/cart', 'Shop::cart');
$routes->post('/cart/add', 'Shop::addToCart');
$routes->post('/cart/remove', 'Shop::removeFromCart');
$routes->get('/checkout', 'Shop::checkout');
$routes->post('/checkout/process', 'Shop::processCheckout');

// Static Pages
$routes->get('/about', 'Pages::about');
$routes->get('/contact', 'Pages::contact');
$routes->post('/contact/submit', 'Pages::contactSubmit');

// Authentication - Using CodeIgniter Shield
service('auth')->routes($routes);

// Admin Panel (Protected by Shield Authentication)
$routes->group('admin', ['filter' => 'session'], function($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Bookings Management
    $routes->get('bookings', 'Admin\Bookings::index');
    $routes->get('bookings/view/(:num)', 'Admin\Bookings::view/$1');
    $routes->post('bookings/update-status', 'Admin\Bookings::updateStatus');
    
    // Calendar Management
    $routes->get('calendar', 'Admin\Calendar::index');
    $routes->post('calendar/block', 'Admin\Calendar::blockDate');
    $routes->post('calendar/unblock', 'Admin\Calendar::unblockDate');
    
    // Available Dates Manager (Simple Date Control)
    $routes->get('available-dates-manager', 'Admin\AvailableDatesManager::index');
    $routes->get('available-dates-manager/create', 'Admin\AvailableDatesManager::create');
    $routes->post('available-dates-manager/store', 'Admin\AvailableDatesManager::store');
    $routes->get('available-dates-manager/bulk-create', 'Admin\AvailableDatesManager::bulkCreate');
    $routes->post('available-dates-manager/store-bulk', 'Admin\AvailableDatesManager::storeBulk');
    $routes->post('available-dates-manager/toggle-status/(:num)', 'Admin\AvailableDatesManager::toggleStatus/$1');
    $routes->post('available-dates-manager/delete/(:num)', 'Admin\AvailableDatesManager::delete/$1');
    
    // Available Time Slots Management (Soft Opening)
    $routes->get('available-slots', 'Admin\AvailableSlots::index');
    $routes->get('available-slots/create', 'Admin\AvailableSlots::create');
    $routes->post('available-slots/store', 'Admin\AvailableSlots::store');
    $routes->get('available-slots/quick-create', 'Admin\AvailableSlots::quickCreate');
    $routes->get('available-slots/toggle/(:num)', 'Admin\AvailableSlots::toggle/$1');
    $routes->get('available-slots/delete/(:num)', 'Admin\AvailableSlots::delete/$1');
    
    // Products Management
    $routes->get('products', 'Admin\Products::index');
    $routes->get('products/create', 'Admin\Products::create');
    $routes->post('products/store', 'Admin\Products::store');
    $routes->get('products/edit/(:num)', 'Admin\Products::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\Products::update/$1');
    $routes->post('products/delete/(:num)', 'Admin\Products::delete/$1');
    
    // Orders Management
    $routes->get('orders', 'Admin\Orders::index');
    $routes->get('orders/view/(:num)', 'Admin\Orders::view/$1');
    
    // Settings
    $routes->get('settings', 'Admin\Settings::index');
    $routes->post('settings/update', 'Admin\Settings::update');
    
    // Business Hours
    $routes->get('business-hours', 'Admin\BusinessHours::index');
    $routes->post('business-hours/update', 'Admin\BusinessHours::update');
});
