<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});


Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::post('addProject', [ProjectController::class, 'addProject']);
Route::get('getProject', [ProjectController::class, 'getProject']);
Route::put('/{id}', [ProjectController::class, 'update']);
Route::delete('/{id}', [ProjectController::class, 'destroy']);

/*
Route::resource('projects', ProjectController::class)->except(['create', 'show']);
Route::resource('tasks', TaskController::class)->except(['create', 'show']);
*/