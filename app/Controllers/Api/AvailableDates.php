<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\AvailableDateModel;

class AvailableDates extends BaseController
{
    protected $availableDateModel;

    public function __construct()
    {
        $this->availableDateModel = new AvailableDateModel();
    }

    /**
     * GET /api/available-dates
     * Returns array of available dates in YYYY-MM-DD format
     */
    public function index()
    {
        try {
            $dates = $this->availableDateModel->getActiveDates();
            
            return $this->response->setJSON([
                'status' => 'success',
                'dates' => $dates
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error fetching available dates: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unable to fetch available dates',
                'dates' => []
            ])->setStatusCode(500);
        }
    }
}

