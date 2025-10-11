<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Services extends BaseController
{
    protected $serviceModel;
    
    public function __construct()
    {
        $this->serviceModel = new \App\Models\ServiceModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Our Services',
            'services' => $this->serviceModel->where('is_active', 1)->findAll()
        ];
        
        return view('layout/header', $data)
             . view('services/index', $data)
             . view('layout/footer', $data);
    }
    
    public function view($slug = null)
    {
        if (!$slug) {
            return redirect()->to('/services');
        }
        
        $service = $this->serviceModel->where('slug', $slug)->where('is_active', 1)->first();
        
        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $data = [
            'title' => $service['name'],
            'service' => $service
        ];
        
        return view('layout/header', $data)
             . view('services/view', $data)
             . view('layout/footer', $data);
    }
}
