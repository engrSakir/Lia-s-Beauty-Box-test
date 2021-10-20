<?php

use App\Http\Controllers\Backend\AppointmentController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\ServiceCategoryController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\ExpenseCategoryController;
use App\Http\Controllers\Backend\ScheduleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\ImageCategoryController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\QuestionaireController;
use App\Http\Controllers\Backend\UserCategoryController;
use App\Http\Controllers\Backend\EmployeeSalaryController;
use App\Http\Controllers\Backend\ReferralDiscountPercentageController;
use App\Http\Controllers\Backend\PaymentMethodController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Backend Routes
|--------------------------------------------------------------------------
|
*/

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('account', [DashboardController::class, 'account'])->middleware(['auth', 'role:Admin'])->name('account');

Route::group(['as' => 'backend.', 'prefix' => 'backend/', 'middleware' => 'auth'], function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile', [ProfileController::class, 'update']);

    Route::group(['middleware' => ['role:Admin|Employee']], function () {
        Route::get('payment/{invoice}', [InvoiceController::class, 'payment'])->name('invoice.payment');
        Route::patch('payment/{invoice}', [InvoiceController::class, 'paymentStore']);
        Route::get('payment-receipt/{payment}', [InvoiceController::class, 'paymentReceipt'])->name('paymentReceipt');
        Route::get('/ajax/get-items-by-category/{category}', [InvoiceController::class, 'getItemsBycategory'])->middleware(['auth'])->name('getItemsBycategory');


        Route::resource('appointment', AppointmentController::class);
        Route::resource('invoice', InvoiceController::class);
        Route::resource('schedule', ScheduleController::class);
        Route::resource('service', ServiceController::class);
        Route::resource('serviceCategory', ServiceCategoryController::class);
    });

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('setting', [SettingController::class, 'index'])->name('setting');
        Route::post('setting', [SettingController::class, 'update']);
        Route::get('admin', [DashboardController::class, 'indexAdmin'])->name('admin.index');
        Route::get('employee', [DashboardController::class, 'indexEmployee'])->name('employee.index');
        Route::get('customer', [DashboardController::class, 'indexCustomer'])->name('customer.index');
        Route::get('/appointment-data/customer-information', [AppointmentController::class, 'customerInfo'])->name('ajax.customerInfo');
        Route::post('/change-user-category', [UserController::class, 'changeUsercategory'])->name('ajax.changeUserCategory');
        Route::get('/report', [DashboardController::class, 'indexReport'])->name('report.index');
        Route::post('/report', [DashboardController::class, 'storeReport'])->name('report.store');


        Route::resource('user', UserController::class);
        Route::resource('client', ClientController::class);
        Route::resource('gallery', GalleryController::class);
        Route::resource('imageCategory', ImageCategoryController::class);
        Route::resource('expense', ExpenseController::class);
        Route::resource('expenseCategory', ExpenseCategoryController::class);
        Route::resource('banner', BannerController::class);
        Route::resource('testimonial', TestimonialController::class);
        Route::resource('questionaire', QuestionaireController::class);
        Route::resource('userCategory', UserCategoryController::class);
        Route::resource('employeeSalary', EmployeeSalaryController::class);
        Route::resource('referralDiscountPercentage', ReferralDiscountPercentageController::class);
        Route::resource('paymentMethod', PaymentMethodController::class);

    });
});
