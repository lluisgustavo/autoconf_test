<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'make_id',
        'name',
        'manufacturing_year',
        'fuel_type',
        'type',
    ];

    public function make()
    {
        return $this->belongsTo(Make::class, 'make_id');
    }
}
