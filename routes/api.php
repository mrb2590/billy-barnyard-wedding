<?php

use App\Http\Controllers\Api\AuthUserController;
use App\Http\Controllers\Api\GuestController;
use App\Http\Controllers\Api\PartyController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthUserController::class, 'show'])->name('user');

    Route::resource('parties', PartyController::class)->except(['create', 'edit']);
    Route::resource('guests', GuestController::class)->except(['create', 'edit']);
});
