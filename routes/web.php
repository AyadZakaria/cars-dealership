<?php

use Illuminate\Support\Facades\Route;

use App\Models\Car;

Route::get('/', function () {
    $cars = Car::paginate(12);
    return view('welcome', compact('cars'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $cars = Car::paginate(12);
        return view('dashboard', compact('cars'));
    })->name('dashboard');
});

// Car details and reservation
use App\Http\Controllers\CarController;

Route::get('/cars/{uuid}', [CarController::class, 'show'])->name('car.details');
Route::post('/cars/{uuid}/reserve', [CarController::class, 'reserve'])->name('car.reserve');
