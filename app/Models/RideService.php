<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideService extends Model
{
    use HasFactory;
    use Timestamp;

    protected $guarded = [];
    public $incrementing = false;

    public function vehiclesTypes()
    {
        return  $this->belongsTo(VehicleType::class);
    }
}
