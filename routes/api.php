<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LocationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CityController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware(['validateToken'])->group(function () {
 
   Route::get('/locations', [LocationController::class, 'showLocations']);
   Route::post('/locations/country/add', [CountryController::class, 'createCountry']);
   Route::post('/locations/country/update/{countryId}', [CountryController::class, 'updateCountry']);

   Route::post('/locations/department/add', [DepartmentController::class, 'createDepartment']);
   Route::post('/locations/department/update/{departmentId}', [DepartmentController::class, 'updateDepartment']);

   Route::post('/locations/city/add', [CityController::class, 'createCity']);
   Route::post('/locations/city/update/{cityId}', [CityController::class, 'updateCity']);
 
});



