<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ToggleView extends BaseController
{
    /**
     * Toggle between admin and customer view
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function toggle()
    {
        // Check if user is logged in and is admin
        if (!auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        $user = auth()->user();
        
        if (!isset($user->is_admin) || $user->is_admin != 1) {
            return redirect()->to('/')->with('error', 'Access denied.');
        }

        // Get current view mode from session
        $currentMode = session()->get('view_mode') ?? 'customer';
        
        // Toggle the mode
        $newMode = ($currentMode === 'admin') ? 'customer' : 'admin';
        
        // Store in session
        session()->set('view_mode', $newMode);
        
        // Redirect based on new mode
        if ($newMode === 'admin') {
            return redirect()->to('/admin')->with('message', 'Switched to Admin View');
        } else {
            return redirect()->to('/')->with('message', 'Switched to Customer View');
        }
    }
    
    /**
     * Get current view mode
     * 
     * @return string
     */
    public static function getCurrentMode(): string
    {
        return session()->get('view_mode') ?? 'customer';
    }
    
    /**
     * Check if user is in admin view
     * 
     * @return bool
     */
    public static function isAdminView(): bool
    {
        return self::getCurrentMode() === 'admin';
    }
}

