<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\Front\HomeController;

// Doctor Controllers
use App\Http\Controllers\Doctor\AuthController as DoctorAuthController;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointmentController;

/*
|--------------------------------------------------------------------------
| Admin Auth (separate admin guard)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Panel (protected by admin guard)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', fn () => redirect()->route('admin.dashboard'))->name('home');

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('departments', DepartmentController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('doctors', DoctorController::class)->except(['show']);
    Route::resource('faqs', FaqController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::resource('galleries', GalleryController::class)->except(['show']);
    Route::resource('appointments', AdminAppointmentController::class)->except(['show']);
});

/*
|--------------------------------------------------------------------------
|  Doctor Auth + Doctor Panel
|--------------------------------------------------------------------------
*/
Route::prefix('doctor')->name('doctor.')->group(function () {

    // Login (guest doctor only)
    Route::middleware('guest:doctor')->group(function () {
        Route::get('login', [DoctorAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [DoctorAuthController::class, 'login'])->name('login.submit');
    });

    // Doctor panel (auth doctor only)
    Route::middleware('auth:doctor')->group(function () {

        Route::post('logout', [DoctorAuthController::class, 'logout'])->name('logout');

        Route::get('/', fn () => redirect()->route('doctor.dashboard'))->name('home');

        Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');

        // Doctor appointments (ONLY his own appointments)
        Route::get('/appointments', [DoctorAppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/appointments/{appointment}/edit', [DoctorAppointmentController::class, 'edit'])->name('appointments.edit');
        Route::put('/appointments/{appointment}', [DoctorAppointmentController::class, 'update'])->name('appointments.update');
    });
});

/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/
Route::name('front.')->group(function () {

    Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');

    Route::post('/appointments', [\App\Http\Controllers\Front\AppointmentController::class, 'store'])
        ->name('appointments.store');

    Route::post('/contact', [\App\Http\Controllers\Front\ContactController::class, 'store'])
        ->name('contact.store');
});
