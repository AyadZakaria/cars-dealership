<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $cars = \App\Models\Car::paginate(12);
    return view('welcome', compact('cars'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $cars = \App\Models\Car::paginate(12);
        return view('dashboard', compact('cars'));
    })->name('dashboard');
});

// Car details and reservation
use App\Http\Controllers\CarController;
use App\Http\Middleware\IsAdmin;

Route::get('/cars/{uuid}', [CarController::class, 'show'])->name('car.details');
Route::post('/cars/{uuid}/reserve', [CarController::class, 'reserve'])->name('car.reserve');

// Admin panel routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('cars', \App\Http\Controllers\Admin\CarController::class)->middleware([IsAdmin::class]);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->middleware([IsAdmin::class]);
    Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class)->middleware([IsAdmin::class]);
    Route::resource('reservations', \App\Http\Controllers\Admin\ReservationController::class)->middleware([IsAdmin::class]);
});
