<?php

use App\Http\Controllers\Api\AccidentController;
use App\Http\Controllers\Api\FineController;
use App\Http\Controllers\Api\PeopleController;
use App\Http\Controllers\Api\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('people')->group(function () {
    Route::get('/index',[PeopleController::class, 'index']);
    Route::post('/store',[PeopleController::class, 'store']);
    Route::get('/show/{people}',[PeopleController::class,'show']);
    Route::put('/update/{people}',[PeopleController::class,'update']);
    Route::delete('/destroy/{people}',[PeopleController::class,'destroy']);
});

Route::prefix('vehicle')->group(function () {
    Route::get('/index',[VehicleController::class, 'index']);
    Route::post('/store',[VehicleController::class, 'store']);
    Route::get('/show/{vehicle}',[VehicleController::class,'show']);
    Route::put('/update/{vehicle}',[VehicleController::class,'update']);
    Route::delete('/destroy/{vehicle}',[VehicleController::class,'destroy']);
});

Route::prefix('fine')->group(function () {
    Route::get('/index',[FineController::class, 'index']);
    Route::post('/store',[FineController::class, 'store']);
    Route::get('/show/{fine}',[FineController::class,'show']);
    Route::put('/update/{fine}',[FineController::class,'update']);
    Route::delete('/destroy/{fine}',[FineController::class,'destroy']);
});

Route::prefix('accident')->group(function () {
    Route::get('/index',[AccidentController::class, 'index']);
    Route::post('/store',[AccidentController::class, 'store']);
    Route::get('/show/{accident}',[AccidentController::class,'show']);
    Route::put('/update/{accident}',[AccidentController::class,'update']);
    Route::delete('/destroy/{accident}',[AccidentController::class,'destroy']);
});