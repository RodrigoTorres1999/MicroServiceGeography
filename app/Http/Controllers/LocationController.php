<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class LocationController extends Controller
{
    public function showLocations()
    {
        // Obtener todos los países con sus departamentos y ciudades
        $countries = Country::with('departments.cities')->get();
        return response()->json($countries);
    }
}
