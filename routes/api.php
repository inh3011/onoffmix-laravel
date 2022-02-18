<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MeetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;
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

// Route::get('/meets', [MeetController::class, 'index'] );

// public routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/meets', [MeetController::class, 'show'] );
Route::get('/forms', [FormController::class, 'show'] );


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/meets', [MeetController::class, 'create'] );
    Route::put('/meets/{id}', [MeetController::class, 'update'] );
    Route::delete('/meets/{id}', [MeetController::class, 'destory'] );

    Route::post('/forms', [FormController::class, 'create'] );
    Route::put('/forms/{id}', [FormController::class, 'update'] );
    Route::delete('/forms/{id}', [FormController::class, 'destory'] );

    Route::post('/logout', [UserController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
