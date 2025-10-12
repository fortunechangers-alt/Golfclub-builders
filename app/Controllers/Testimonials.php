<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Testimonials extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Customer Reviews',
        ];

        return view('layout/header', $data)
            . view('testimonials/index', $data)
            . view('layout/footer', $data);
    }
}
