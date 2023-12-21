<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class LocationController extends Controller
{
    public function showLocations()
{
    // Obtener todos los países con sus departamentos y ciudades en orden alfabético
    $countries = Country::with(['departments' => function ($query) {
        $query->orderBy('department', 'asc')->with(['cities' => function ($cityQuery) {
            $cityQuery->orderBy('city', 'asc');
        }]);
    }])->orderBy('country', 'asc')->get();

    return response()->json($countries);
}
}
