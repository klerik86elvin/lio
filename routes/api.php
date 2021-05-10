<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function (){
  $e = \App\Employee::find(1);

  return response()->json($e->createdTasks()->get());
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('registration', 'AuthController@registration');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::post('employee/login', 'EmployeeController@login');
Route::post('employee/logout', 'EmployeeController@logout');
Route::post('employee/registration', 'EmployeeController@registration');
Route::post('employee/me', 'EmployeeController@me');
Route::put('employee', 'EmployeeController@update');
Route::get('employee/created-tasks', 'EmployeeController@getCreatedTasks');
Route::get('employee/assigned-tasks', 'EmployeeController@getAssignedTasks');
Route::post('task/{task_id}/comments', 'API\TaskController@addComment');
Route::get('task/{task_id}/comments', 'API\TaskController@getComments');
Route::delete('project/{id}/status/{status_id}', 'API\ProjectController@detachStatus');

Route::group([
    'prefix' => 'project'
], function () {
    Route::delete('{id}/department', 'API\ProjectController@dissociateDepartment');
});



Route::apiResources([
    'project' => 'API\ProjectController',
    'department' => 'API\DepartmentController',
    'task' => 'API\TaskController',
    'status' => 'API\StatusController'

]);


