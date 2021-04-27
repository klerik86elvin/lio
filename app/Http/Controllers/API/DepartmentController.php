<?php

namespace App\Http\Controllers\API;

use App\Department;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'message' => 'success',
            'data' => Department::all(),
        ];

        return response()->json($data,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $data = [
            'message' => '',
            'data' => null,
        ];

        $dep = Department::create([
            'name' => $request->name,
        ]);

        if ($dep)
        {
            $data['message'] = 'success';
            return response()->json($data, 200);
        }
        else
        {
            $data['message'] = 'error';
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::findOrFail($id);

        $data = [
            'message' => 'success',
            'data' => $department,
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        $department = Department::findOrFail($id);

        $data = [
            'message' => 'success',
            'data' => $department,
        ];
        $department->update([
            'name' => $request->name,
        ]);

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);

        $data = [
            'message' => 'success',
            'data' => null
        ];

        $department->delete();

        return response()->json($data, 200);
    }
}
