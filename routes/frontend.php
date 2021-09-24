<?php
use App\Http\Controllers\Frontend\FrontEndController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Frontend Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [FrontEndController::class, 'home'])->name('home');
Route::get('/booking', [FrontEndController::class, 'booking'])->name('booking');
Route::post('/booking', [FrontEndController::class, 'bookingStore']);
Route::get('/service', [FrontEndController::class, 'service'])->name('service');
Route::get('/service/{slug}', [FrontEndController::class, 'serviceDetails'])->name('serviceDetails');
Route::post('/contact-us', [FrontEndController::class, 'handleContactForm']);


