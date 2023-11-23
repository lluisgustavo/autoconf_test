<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Make extends Model
{
    use HasFactory;
    use SoftDeletes;

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
