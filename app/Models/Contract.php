<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
    ];
    
    public function contractDetails()
    {
        return $this->hasMany(ContractDetails::class, 'contract_id');
    }
}
