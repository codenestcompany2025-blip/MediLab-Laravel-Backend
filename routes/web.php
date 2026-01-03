<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Admin Controllers
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\AppointmentController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| 
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Show login page
    Route::get('/login', function () {
        return view('admin.auth.login');
    })->name('login');

    // Handle login submit (POST) - ANY EMAIL / ANY PASSWORD
    Route::post('/login', function (Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Create user automatically if not exists (Demo Login)
        $user = \App\Models\User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => 'Demo User',
                'password' => 'password',
            ]
        );

        // Login without password check
        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');

    })->name('login.submit');

    // Logout
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    })->name('logout');
});

/*
|--------------------------------------------------------------------------
| Protected Admin Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', fn () => redirect()->route('admin.dashboard'))->name('home');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD
    Route::resource('departments', DepartmentController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('galleries', GalleryController::class);

    // Appointments
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::delete('appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::patch('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.status');

    // Template pages
    Route::get('buttons', fn () => view('admin.placeholders.simple', ['title' => 'Buttons']))->name('buttons');
    Route::get('cards', fn () => view('admin.placeholders.simple', ['title' => 'Cards']))->name('cards');

    Route::get('utilities/colors', fn () => view('admin.placeholders.simple', ['title' => 'Utilities - Colors']))->name('utilities.colors');
    Route::get('utilities/borders', fn () => view('admin.placeholders.simple', ['title' => 'Utilities - Borders']))->name('utilities.borders');
    Route::get('utilities/animations', fn () => view('admin.placeholders.simple', ['title' => 'Utilities - Animations']))->name('utilities.animations');
    Route::get('utilities/other', fn () => view('admin.placeholders.simple', ['title' => 'Utilities - Other']))->name('utilities.other');

    Route::get('charts', fn () => view('admin.placeholders.simple', ['title' => 'Charts']))->name('charts');
    Route::get('tables', fn () => view('admin.pages.tables'))->name('tables');

    // 2 Pages (placeholders to avoid RouteNotFound)
    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('login', fn () => redirect()->route('admin.login'))->name('login');
        Route::get('register', fn () => view('admin.placeholders.simple', ['title' => 'Register']))->name('register');
        Route::get('forgot-password', fn () => view('admin.placeholders.simple', ['title' => 'Forgot Password']))->name('forgot-password');
        Route::get('blank', fn () => view('admin.placeholders.simple', ['title' => 'Blank Page']))->name('blank');
        Route::get('404', fn () => view('admin.placeholders.simple', ['title' => '404 Page']))->name('404');
    });

});
