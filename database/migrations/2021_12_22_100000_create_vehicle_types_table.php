<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateVehicleTypesTable extends Migration
{
    const VEHICLES_KEY_NAME = [
        "sedán" => "Sedán",
        "van" => "Furgoneta",
        "suv" => "Suv"
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->string('key', 255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        $this->insertVehicles();
    }

    public function insertVehicles()
    {
        $inserts = [];
        $now = now();
        foreach (self::VEHICLES_KEY_NAME as $key => $vehicle) {
            $inserts[] = [
                'id' => Str::uuid(),
                'name' => $vehicle,
                'key' => $key,
                'created_at' => $now,
            ];
        }
        DB::table('vehicle_types')->insert($inserts);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_types');
    }
}
