<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{

    public function createCity(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'city' => 'required|string|unique:cities',
            'department_id' => 'required|string',
        ], [
            'city.unique' => 'La ciudad/distrito ya existe.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $city = City::create([
            'city' => $request->input('city'),
            'department_id' => $request->input('department_id'),
           
        ]);

        return response()->json($city, 201);
    }

    public function updateCity(Request $request, $cityId)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'string|unique:cities,city,' . $cityId,
            'department_id' => 'required',
        ], [
            'city.unique' => 'La ciudad/distrito ya existe.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $city = City::find($cityId);

        $city->update([
            'city' => $request->input('city'),
            'department_id' => $request->input('department_id'),
        ]);

        return response()->json($city);
    }
}
