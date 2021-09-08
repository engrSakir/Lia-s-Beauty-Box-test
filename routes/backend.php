<?php

use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Backend Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
})->middleware(['auth'])->name('dashboard');


Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update']);

Route::get('/setting', [SettingController::class, 'index'])->name('setting');
Route::get('/setting', [SettingController::class, 'update']);

