<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AvailableDateModel;

class AvailableDatesManager extends BaseController
{
    protected $availableDateModel;

    public function __construct()
    {
        $this->availableDateModel = new AvailableDateModel();
        helper(['form', 'url']);
    }

    /**
     * Display all available dates
     */
    public function index()
    {
        $dates = $this->availableDateModel
                     ->orderBy('date', 'ASC')
                     ->findAll();

        $data = [
            'title' => 'Manage Available Dates',
            'dates' => $dates
        ];

        return view('admin/layout/header', $data)
            . view('admin/available_dates_manager/index', $data)
            . view('admin/layout/footer', $data);
    }

    /**
     * Show form to add new available date
     */
    public function create()
    {
        $data = [
            'title' => 'Add Available Date',
            'validation' => \Config\Services::validation()
        ];

        return view('layout/admin_header', $data)
            . view('admin/available_dates_manager/create', $data)
            . view('layout/admin_footer', $data);
    }

    /**
     * Store new available date
     */
    public function store()
    {
        $rules = [
            'date' => 'required|valid_date',
            'notes' => 'permit_empty|string|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $date = $this->request->getPost('date');
        $notes = $this->request->getPost('notes');

        // Check if date already exists
        $existing = $this->availableDateModel->where('date', $date)->first();
        
        if ($existing) {
            return redirect()->back()->with('error', 'This date is already available.');
        }

        $this->availableDateModel->insert([
            'date' => $date,
            'notes' => $notes,
            'is_active' => 1
        ]);

        return redirect()->to(base_url('/admin/available-dates-manager'))
                        ->with('success', 'Date added successfully!');
    }

    /**
     * Delete an available date
     */
    public function delete($id)
    {
        $date = $this->availableDateModel->find($id);
        
        if (!$date) {
            return redirect()->back()->with('error', 'Date not found.');
        }

        $this->availableDateModel->delete($id);

        return redirect()->to(base_url('/admin/available-dates-manager'))
                        ->with('success', 'Date removed successfully!');
    }

    /**
     * Toggle active status
     */
    public function toggleStatus($id)
    {
        $date = $this->availableDateModel->find($id);
        
        if (!$date) {
            return redirect()->back()->with('error', 'Date not found.');
        }

        $newStatus = $date['is_active'] ? 0 : 1;
        $this->availableDateModel->update($id, ['is_active' => $newStatus]);

        $message = $newStatus ? 'Date activated!' : 'Date deactivated!';
        return redirect()->back()->with('success', $message);
    }

    /**
     * Bulk add dates (for convenience)
     */
    public function bulkCreate()
    {
        $data = [
            'title' => 'Bulk Add Dates',
            'validation' => \Config\Services::validation()
        ];

        return view('layout/admin_header', $data)
            . view('admin/available_dates_manager/bulk_create', $data)
            . view('layout/admin_footer', $data);
    }

    /**
     * Store bulk dates
     */
    public function storeBulk()
    {
        $rules = [
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date',
            'notes' => 'permit_empty|string|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');
        $notes = $this->request->getPost('notes');

        $currentDate = $startDate;
        $addedCount = 0;

        while ($currentDate <= $endDate) {
            // Check if date already exists
            $existing = $this->availableDateModel->where('date', $currentDate)->first();
            
            if (!$existing) {
                $this->availableDateModel->insert([
                    'date' => $currentDate,
                    'notes' => $notes,
                    'is_active' => 1
                ]);
                $addedCount++;
            }

            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        return redirect()->to(base_url('/admin/available-dates-manager'))
                        ->with('success', "{$addedCount} dates added successfully!");
    }
}

