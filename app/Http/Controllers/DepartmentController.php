<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    
    public function createDepartment(Request $request)
    {
        // Validar los datos del departamento
        $validator = Validator::make($request->all(), [
            'department' => 'required|string|unique:departments',
            'country_id' => 'required|string',
        ], [
            'department.unique' => 'El departamento ya existe.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $department = Department::create([
            'department' => $request->input('department'),
            'country_id' => $request->input('country_id'),
        ]);

        return response()->json($department, 201);
    }


    public function updateDepartment(Request $request, $departmentId)
    {
        $validator = Validator::make($request->all(), [
            'department' => 'string|unique:departments,department,' . $departmentId,
            'country_id' => 'required',
        ], [
            'department.unique' => 'El departamento ya existe.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $department = Department::find($departmentId);

        $department->update([
            'department' => $request->input('department'),
            'country_id' => $request->input('country_id'),
        ]);

        return response()->json($department);
    }
}
