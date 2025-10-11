<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Home'
        ];
        
        return view('layout/header', $data)
             . view('home/index', $data)
             . view('layout/footer', $data);
    }
}
