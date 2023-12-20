<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;

class CountryController extends Controller
{

    public function createCountry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'string|unique:countries',
            'code' => 'string|unique:countries',
            'dial_code' => 'string',
        ], [
            'country.unique' => 'El país ya existe.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $country = Country::create([
            'country' => $request->input('country'),
            'code' => $request->input('code'),
            'dial_code' => $request->input('dial_code'),
        ]);
        return response()->json($country, 201);
    }


    public function updateCountry(Request $request, $countryId)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'string|unique:countries,country,' . $countryId,
            'code' => '',
            'dial_code' => '',
        ], [
            'country.unique' => 'El país ya existe.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $country = Country::find($countryId);

        $country->update([
            'country' => $request->input('country'),
            'code' => $request->input('code'),
            'dial_code' => $request->input('dial_code'),
        ]);

        return response()->json($country);
    }


}
