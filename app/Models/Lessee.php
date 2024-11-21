<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lessee extends Model
{
    protected $table = 'lessees';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'occupation',
        'birth_year',
        'cccd_number',
        'cccd_front_image',
        'cccd_back_image',
    ];
    
    public function contractDetails()
    {
        return $this->hasMany(ContractDetails::class, 'id_lessee');
    }
}
