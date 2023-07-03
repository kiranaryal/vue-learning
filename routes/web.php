<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\InstructorController;






Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('quiz',QuizController::class);

    Route::resource('vehicle',VehicleController::class);
    Route::resource('courses',CoursesController::class);
    Route::resource('instructor',InstructorController::class);
    Route::get('/find',[InstructorController::class,'find'])->name('instructor.find');
    Route::post('/instructor/get',[InstructorController::class,'getInstructors'])->name('instructor.get');


});


