<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*---HOME---*/
Route::get('/', function () {
    return view('welcome');
})->name('home')->middleware('guest');

/*---TABLEAU DE BORD _ PICTURES ---*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');


Route::get('/events', [EventController::class, 'index'])->name('events.index');

/*---LES EVENEMENTS---*/
Route::middleware('auth')->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/events', [EventController::class, 'store'])->name('event.store');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('event.show');

    Route::post('/events/{event}/participate', [EventController::class, 'participate'])->name('events.participate');
    Route::post('/events/{event}/detach', [EventController::class, 'detach'])
        ->name('events.detach');

});

/*---ADMIN---*/
Route::group(['middleware' => ['auth','admin' ]], function () {
    Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
    Route::post('/admin/update/{id}', [UserController::class, 'updateUser'])->name('admin.updateUser');
});

/*---MODIF DE SON PROFIL---*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/export', [ProfileController::class, 'exportJson'])->name('export');
});

require __DIR__ . '/auth.php';
