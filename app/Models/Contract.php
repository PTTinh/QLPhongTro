<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'created_date',
        'start_date',
        'end_date',
        'month',
        'price_eletric',
        'price_water',
        'other_fees',
        'created_by',
        'room_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function contractDetails()
    {
        return $this->hasMany(ContractDetails::class, 'contract_id');
    }
}
