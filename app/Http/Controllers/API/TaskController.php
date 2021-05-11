<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\TaskRequest;
use App\Policies\TaskPolicy;
use App\Project;
use App\Status;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('assign.auth:employee_api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'message' => 'success',
            'data' => Task::all(),
        ];

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
       $data = Task::create($request->only(['name', 'text','assigned_to','deadline','project_id','status_id']));

       return response()->json(['message' => 'success', 'data' => $data], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = [
            'message' => 'success',
            'data' => Task::findOrFail($id),
        ];

        return response()->json($message, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $t = Task::findOrFail($id);

        $response = Gate::forUser(Auth::guard('employee_api')->user())->inspect('update', $t);

        if ($response->allowed()) {
            $this->validate($request,[
                'name' => ['required'],
                'assigned_to' => ['nullable', Rule::in(Employee::all()->pluck('id'))],
                'project_id' => ['nullable', Rule::in(Project::all()->pluck('id'))],
                'status_id' => ['nullable', Rule::in(Status::all()->pluck('id'))],
            ]);
            $t->update($request->only(['name', 'text', 'assigned_to', 'project_id', 'status_id']));
            return response()->json(['message' => 'success', 'data' => $t], 200);
        } else {
//            return 'ok';
            return response()->json(['message' => $response->message()], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function addComment(CommentRequest $request, $task_id)
    {
        $task = Task::findOrFail($task_id);

        $c = Comment::create($request->only(['text']));

        $c->task()->associate($task);

        $c->save();

        return response()->json(['message' => 'success'], 200);
    }

    public function getComments($task_id)
    {
        $comments = Comment::where('task_id', $task_id)->get();

        return response()->json(['message' => 'success', 'data' => $comments], 200);
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return response()->json(['message' => 'success'], 200);
    }
}
