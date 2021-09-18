<?php

use App\Http\Controllers\Backend\AppointmentController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\ServiceCategoryController;
use App\Http\Controllers\Backend\ScheduleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\ImageCategoryController;
use App\Http\Controllers\Backend\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Backend Routes
|--------------------------------------------------------------------------
|
*/

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::group(['as' => 'backend.', 'prefix' => 'backend/', 'middleware' => 'auth'], function (){
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile', [ProfileController::class, 'update']);
    Route::get('setting', [SettingController::class, 'index'])->name('setting');
    Route::post('setting', [SettingController::class, 'update']);

    Route::get('payment/{invoice}', [InvoiceController::class, 'payment'])->name('invoice.payment');
    Route::patch('payment/{invoice}', [InvoiceController::class, 'paymentStore']);
    Route::get('payment-receipt/{payment}', [InvoiceController::class, 'paymentReceipt'])->name('paymentReceipt');

    Route::resource('schedule', ScheduleController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('serviceCategory', ServiceCategoryController::class);
    Route::resource('user', UserController::class);
    Route::resource('client', ClientController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('imageCategory', ImageCategoryController::class);
    Route::resource('appointment', AppointmentController::class);
    Route::resource('invoice', InvoiceController::class);





});



