<?php

use App\Http\Controllers\SimulatorController;
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

Route::get('/institutions', [SimulatorController::class, 'listInstitutions']);
Route::get('/covenants', [SimulatorController::class, 'listCovenants']);
Route::get('/feesInstitutions', [SimulatorController::class, 'listFeesInstitutions']);
Route::post('/simulate', [SimulatorController::class, 'simulate']);