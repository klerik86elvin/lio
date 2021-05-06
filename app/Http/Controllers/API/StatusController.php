<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Status\Create;
use App\Http\Requests\Status\Update;
use App\Http\Requests\StatusRequest;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
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
            'data' => null,
        ];

        $statuses = Status::all();

        $data['data'] = $statuses;

        return response()->json($data, 200);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusRequest $request)
    {
        $data = [
            'message' => 'success',
            'data' => null,
        ];

        $status = Status::create($request->only(['name']));

        $data['status'] = $status;

        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'message' => 'success',
            'data' => null,
        ];

        $status = Status::findOrFail($id);

        $data['data'] = $status;

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatusRequest $request, $id)
    {
        $data = [
            'message' => 'success',
            'data' => null,
        ];

        $status = Status::findOrFail($id);

        $status->update($request->only(['name']));

        $data['data'] = $status;

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
        $status = Status::findOrFail($id);

        $status->delete();

        $data = [
            'message' => 'success',
            'data' => null
        ];

        return response()->json($data, 200);
    }
}
