<?php

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


Route::get('/profile', 'App\Http\Controllers\Backend\ProfileController@index')->name('profile');

Route::post('/profile-update', 'App\Http\Controllers\Backend\ProfileController@store')->name('profile.update');

Route::get('/settings', 'App\Http\Controllers\Backend\SettingsController@index')->name('settings');

