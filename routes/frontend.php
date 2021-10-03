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
Route::get('/contact-us', [FrontEndController::class, 'getContactForm']);
Route::post('/contact-us', [FrontEndController::class, 'handleContactForm']);
Route::get('/register/{referral_code}', [FrontEndController::class, 'getRegisterFormWithRefCode'])->name('refRegister');
Route::patch('/register/{referral_code}', [FrontEndController::class, 'registrationWithRefCode'])->middleware(['guest']);


