<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'founding_year',
        'country_of_origin',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'make_id');
    }

    public function models()
    {
        return $this->hasMany(VehicleModel::class, 'make_id');
    }
}
