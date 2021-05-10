<?php

namespace App\Http\Controllers\API;

use App\Department;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Project;
use App\Status;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
            'data' => Project::with('statuses.tasks')->get()
        ];

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $data = [
            'message' => 'success',
            'data' => null,
        ];
        $dep = Department::find($request->department);
        $pro = Project::create([
            'name' => $request->name
        ]);

        $pro->department()->associate($dep);
        $pro->statuses()->attach($request->status_id);
        $pro->save();

        if ($pro)
        {
            $data['data'] = $pro;
        }

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
            'data' => Project::findOrFail($id),
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
    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);

        $data = [
            'message' => 'success',
            'data' => $project,
        ];

        $project->update([
            'name' => $request->name,
        ]);
        $department = Department::find($request->department);

        $project->department()->associate($department);
        $project->statuses()->sync($request->status_id);
        $project->save();
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
        $project = Project::findOrFail($id);

        $project->delete();

        return response()->json(['message' => 'success'], 200);
    }

    public function dissociateDepartment($id)
    {
        $project = Project::findOrFail($id);

        $project->department()->dissociate();

        $project->save();

        return response()->json(['message' => 'success', 'data' => $project]);
    }

    public function detachStatus($id, $status_id)
    {
        $data = [
            'message' => 'success',
        ];
        $project = Project::findOrFail($id);

        $project->statuses()->detach($status_id);

        return response()->json($data, 200);
    }

}
