<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractDetails extends Model
{
    protected $table = 'contract_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'contract_id',
        'room_id',
        'id_lessee',
        'is_signed',
        'signed_at',
    ];
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    
    public function lessee()
    {
        return $this->belongsTo(Lessee::class, 'id_lessee');
    }
    
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
}
