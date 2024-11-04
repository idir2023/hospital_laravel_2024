<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\{
    AppointmentController,
    BedController,
    BillController,
    DoctorController,
    PrescriptionController,
    MedicalRecordController,
    DepartmentController,
    MedicationController,
    PatientController
};

// Client Routes (accessible to all users without authentication)
Route::name('client.')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('home');
    Route::get('/about', [ClientController::class, 'about'])->name('about');
    Route::view('/contact', 'client.contact')->name('contact');
    Route::view('/doctor', 'client.doctors')->name('doctor');
    Route::post('/get_appointments', [ClientController::class, 'store'])->name('get_appointments');
});

// Authentication Routes
Auth::routes(['verify' => true]);

// Authenticated Routes (for authenticated users only)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('doctors', DoctorController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('patients', PatientController::class);
});

// Admin Routes (accessible only to users with 'admin' role)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('prescriptions', PrescriptionController::class);
    Route::resource('medical_records', MedicalRecordController::class);
    Route::resource('bills', BillController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('medications', MedicationController::class);
    Route::resource('beds', BedController::class);

    // User Management Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('/create', [UsersController::class, 'create'])->name('create');
        Route::post('/create', [UsersController::class, 'store'])->name('store');
        Route::get('/{user}/show', [UsersController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('edit');
        Route::patch('/{user}/update', [UsersController::class, 'update'])->name('update');
        Route::delete('/{user}/delete', [UsersController::class, 'destroy'])->name('destroy');
    });
});
