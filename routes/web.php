<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\AppointmentController;

use App\Models\Appointment;

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Dashboard & Panel
|--------------------------------------------------------------------------
*/
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', fn () => redirect()->route('admin.dashboard'))->name('home');

    /**
     * Dashboard
     * - Statistics
     * - Charts
     * - Latest 4 appointments as summary ONLY
     */
    Route::get('/dashboard', function () {

        $appointmentsCount = Appointment::count();

        $pendingAppointmentsCount   = Appointment::where('status', 'pending')->count();
        $confirmedAppointmentsCount = Appointment::where('status', 'confirmed')->count();
        $cancelledAppointmentsCount = Appointment::where('status', 'cancelled')->count();

        // ✅ Engineer request: ONLY last 4 reservations as summary
        $latestAppointments = Appointment::latest()
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'appointmentsCount',
            'pendingAppointmentsCount',
            'confirmedAppointmentsCount',
            'cancelledAppointmentsCount',
            'latestAppointments'
        ));
    })->name('dashboard');

    Route::resource('departments', DepartmentController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('doctors', DoctorController::class)->except(['show']);
    Route::resource('faqs', FaqController::class)->except(['show']);
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    Route::resource('galleries', GalleryController::class)->except(['show']);
    Route::resource('appointments', AppointmentController::class)->except(['show']);
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
