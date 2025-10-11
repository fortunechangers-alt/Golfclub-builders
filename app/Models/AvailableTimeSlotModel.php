<?php

namespace App\Models;

use CodeIgniter\Model;

class AvailableTimeSlotModel extends Model
{
    protected $table            = 'available_time_slots';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'service_id',
        'date',
        'start_time',
        'end_time',
        'max_bookings',
        'current_bookings',
        'is_active',
        'notes',
        'created_by_admin_id'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'service_id'           => 'required|integer',
        'date'                 => 'required|valid_date',
        'start_time'           => 'required',
        'end_time'             => 'required',
        'created_by_admin_id'  => 'required|integer',
    ];
    
    protected $validationMessages   = [];
    protected $skipValidation       = false;
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
     * Get available slots for a specific date and service
     */
    public function getAvailableSlotsForDate($date, $serviceId)
    {
        return $this->where('date', $date)
                    ->where('service_id', $serviceId)
                    ->where('is_active', 1)
                    ->where('current_bookings <', $this->db->escapeIdentifier('max_bookings'), false)
                    ->findAll();
    }
    
    /**
     * Check if a specific time slot is available
     */
    public function isSlotAvailable($date, $startTime, $serviceId)
    {
        $slot = $this->where('date', $date)
                     ->where('start_time', $startTime)
                     ->where('service_id', $serviceId)
                     ->where('is_active', 1)
                     ->first();
        
        if (!$slot) {
            return false;
        }
        
        return $slot['current_bookings'] < $slot['max_bookings'];
    }
    
    /**
     * Increment the booking count for a slot
     */
    public function incrementBookingCount($slotId)
    {
        $slot = $this->find($slotId);
        if ($slot) {
            return $this->update($slotId, [
                'current_bookings' => $slot['current_bookings'] + 1
            ]);
        }
        return false;
    }
}

