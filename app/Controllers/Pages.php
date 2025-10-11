<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pages extends BaseController
{
    public function about()
    {
        $data = [
            'title' => 'About Us'
        ];
        
        return view('layout/header', $data)
             . view('pages/about', $data)
             . view('layout/footer', $data);
    }
    
    public function contact()
    {
        $data = [
            'title' => 'Contact Us'
        ];
        
        return view('layout/header', $data)
             . view('pages/contact', $data)
             . view('layout/footer', $data);
    }
    
    public function contactSubmit()
    {
        // Handle contact form submission
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'message' => $this->request->getPost('message')
        ];
        
        // For now, just redirect back with success message
        // In production, you'd send an email or save to database
        return redirect()->to('/contact')->with('success', 'Thank you for your message! We\'ll get back to you soon.');
    }
}
