<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MembershipController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserController;
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

// user crud
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::post('/user/create', 'store');
    Route::post('/user/update/{id}', 'update');
    Route::delete('/user/delete/{id}', 'destroy');
});

// auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// membership crud
Route::controller(MembershipController::class)->group(function () {
    Route::get('/memberships', 'index');
    Route::post('/membership/create', 'store');
    Route::post('/membership/update/{id}', 'update');
    Route::delete('/membership/delete/{id}', 'destroy');
});

// subscription

Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
Route::post('/un-subscribe/{id}', [SubscriptionController::class, 'unSubscribe']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
