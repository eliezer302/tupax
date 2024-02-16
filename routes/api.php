<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Call Tasks Controller
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TaskStatusesController;
// Call UsersController
use App\Http\Controllers\UsersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Invoke users
Route::group(['middleware' => 'api'], function() {
    Route::resource('users', UsersController::class)->middleware('auth');
});
Route::get('/api/users', 'UsersController@index');
Route::post('/api/users', 'UsersController@store');
Route::get('/api/users/{id}', 'UsersController@show');
Route::put('/api/users/{id}', 'UsersController@update');
Route::delete('/api/users/{id}', 'UsersController@destroy');

// Invoke tasks
Route::group(['middleware' => 'api'], function() {
    Route::resource('tasks', TasksController::class)->middleware('auth');
});
Route::get('/api/tasks', 'TasksController@index');
Route::post('/api/tasks', 'TasksController@store');
Route::get('/api/tasks/{id}', 'TasksController@show');
Route::put('/api/tasks/{id}', 'TasksController@update');
Route::delete('/api/tasks/{id}', 'TasksController@destroy');

// Invoke tasks status
Route::group(['middleware' => 'api'], function() {
    Route::resource('taskStatuses', TaskStatusesController::class)->middleware('auth');
});
Route::get('/api/taskStatuses', 'TaskStatusesController@index');