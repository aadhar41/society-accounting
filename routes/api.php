<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SocietyController;

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


Route::get('societies', [SocietyController::class, 'index']);
Route::get('/society/{id}', [SocietyController::class, 'show']);
// // Route::apiResource('societies', [SocietyController::class]);

// Route::apiResource('societies', 'Api/SocietyController');