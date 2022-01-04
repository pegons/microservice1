<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    public static $readOnly = true;
    public $incrementing = false;
    protected $guarded = [];

    public function RideServices()
    {
        return $this->belongsToMany(RideService::class);
    }
}
