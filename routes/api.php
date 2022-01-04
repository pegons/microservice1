<?php


use App\Http\Controllers\Health\HealthController;
use App\Http\Controllers\RideService\GetRideServiceController;
use App\Http\Controllers\RideService\PostRideServiceController;
use App\Http\Controllers\RideService\PutRideServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::prefix('microservice1')->group(function () { */

Route::get('/hola', HealthController::class);
Route::get('/ride_service/{ride_service_id}', GetRideServiceController::class);
Route::post('/ride_service', PostRideServiceController::class);
Route::put('/ride_service', PutRideServiceController::class);
/* }); */
