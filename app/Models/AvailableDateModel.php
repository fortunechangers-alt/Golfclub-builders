<?php

namespace App\Models;

use CodeIgniter\Model;

class AvailableDateModel extends Model
{
    protected $table            = 'available_dates';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['date', 'notes', 'is_active'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'date' => 'required|valid_date',
        'is_active' => 'permit_empty|integer|in_list[0,1]',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get all active available dates as an array of date strings
     * @return array
     */
    public function getActiveDates(): array
    {
        $results = $this->where('is_active', 1)
                       ->where('date >=', date('Y-m-d'))
                       ->orderBy('date', 'ASC')
                       ->findAll();
        
        return array_map(fn($row) => $row['date'], $results);
    }
}

