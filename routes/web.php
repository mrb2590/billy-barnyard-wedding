<?php

use App\Http\Controllers\FaviconController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PartySearchController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebAppManifestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/mailable', function () {
    $guest = App\Models\Guest::where('email', 'mrb2590@gmail.com')->first();

    return new App\Mail\RSVPThankYou($guest);
});

Route::get('/', [HomeController::class, 'show'])->name('home');

Route::get('/play', [PlayController::class, 'show'])->name('play');

Route::get('/favicon.ico', [FaviconController::class, 'show']);

Route::get('/site.webmanifest', [WebAppManifestController::class, 'show']);

Route::get('/rsvp', [PartySearchController::class, 'create'])->name('party-search.create');
Route::post('/rsvp', [PartySearchController::class, 'store'])->name('party-search.store');

Route::middleware(['party.verify'])
    ->whereUuid(['party'])
    ->group(function () {
        Route::get('/parties/{party}', [PartyController::class, 'edit'])->name('party.edit');
        Route::patch('/parties/{party}', [PartyController::class, 'update'])->name('party.update');
    });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
