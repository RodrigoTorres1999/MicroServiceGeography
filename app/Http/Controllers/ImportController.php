<?php

namespace App\Http\Controllers;

use App\Imports\LocationImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|mimes:xlsx,csv,excel',
        ]);

        $file = $request->file('excel_file');

        try {
            Excel::import(new LocationImport(), $file);

            return response()->json(['message' => 'Datos importados exitosamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al importar datos. Detalles: '.$e->getMessage()], 500);
        }
    }
}
