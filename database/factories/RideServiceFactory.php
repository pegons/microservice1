<?php

namespace Database\Factories;

use App\Models\RideService;
use App\Models\User;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RideServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RideService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $object = VehicleType::first();

        return [
            'id' => Str::uuid(),
            'pick_up' => "Granada:37.18817:-3.60667",
            'drop_off' => "Barcelona:41.3879:-2.16992",
            'vehicle_type_id' => VehicleType::first()->id
        ];
    }
}
