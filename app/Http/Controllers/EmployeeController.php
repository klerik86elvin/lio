<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Http\Requests\EmployeeRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('assign.auth:employee_api', ['except' => ['login', 'registration']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request,[
            'login' => 'required',
            'password' => 'required'
        ]);

        $credentials = request(['login', 'password']);

        if (! $token = auth()->guard('employee_api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * User registration
     */
    public function registration(EmployeeRequest $request)
    {
        $name = request('name');
        $surname = request('surname');
        $login = request('login');
        $password = request('password');
        $department = request('dep_id');

        $emlopyee = new Employee();
        $emlopyee->name = $name;
        $emlopyee->surname = $surname;
        $emlopyee->department_id = $department;
        $emlopyee->login = $login;
        $emlopyee->password = Hash::make($password);
        $emlopyee->save();

        return response()->json(['message' => 'Successfully registration!'], 200);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->guard('employee_api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('employee_api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getCreatedTasks()
    {
        $em = auth()->guard('employee_api')->user();

        $message = [
            'message' => 'success',
            'data' => $em->createdTasks()->get(),

        ];

        return response()->json($message, 200);

    }

    public function getAssignedTasks()
    {
        $em = auth()->guard('employee_api')->user();

        $message = [
            'message' => 'success',
            'data' => $em->assignedTasks()->get(),

        ];

        return response()->json($message, 200);

    }



    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('employee_api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('employee_api')->factory()->getTTL() * 60
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['message' => 'success', 'data' => Employee::all()], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => ['required'],
            'surname' => ['required'],
            'password' => ['required'],
            'dep_id' => ['nullable', Rule::in(Department::all()->pluck('id'))]
        ]);

        $em = auth()->guard('employee_api')->user();


        $em->name = $request->name;
        $em->surname = $request->surname;
        $em->password = Hash::make($request->password);

        $em->department_id = $request->dep_id;
        $em->save();

        return response()->json(['message' => 'success', 'data' => $em],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
