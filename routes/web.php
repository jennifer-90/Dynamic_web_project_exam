<?php

use App\Http\Controllers\AdminController;
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
})->name('home');

/*---TABLEAU DE BORD _ PICTURES ---*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*---LES EVENEMENTS---*/
Route::middleware('auth')->group(function () {
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
});

/*---ADMIN---*/
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.index');
    Route::post('/admin/update/{id}', [UserController::class, 'updateUser'])->name('admin.updateUser');
});

/*---MODIF DE SON PROFIL---*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
