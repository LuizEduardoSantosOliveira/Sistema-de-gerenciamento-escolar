<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/student', function () {
    return Inertia::render('student/StudentDashboard');
})->middleware(['auth', 'verified'])->name('studentdashboard');

/*Route::get('/student', function () {
    return Inertia::render('student/AboutUs');
})->middleware(['auth', 'verified'])->name('aboutus');*/

Route::get('/student/Calendar', function () {
    return Inertia::render('student/Calendar');
})->middleware(['auth', 'verified'])->name('calendar');

Route::get('/student/Grades', function () {
    return Inertia::render('student/Grades');
})->middleware(['auth', 'verified'])->name('grades');

Route::get('/student/Perfil', function () {
    return Inertia::render('student/Perfil');
})->middleware(['auth', 'verified'])->name('perfil');


Route::get('/student/Requirements', function () {
    return Inertia::render('student/Requirements');
})->middleware(['auth', 'verified'])->name('requirements');


Route::get('/student/ClassSchedule', function () {
    return Inertia::render('student/ClassSchedule');
})->middleware(['auth', 'verified'])->name('classschedule');

Route::get('/student/MakeReservation', function () {
    return Inertia::render('student/MakeReservation');
})->middleware(['auth', 'verified'])->name('makereservation');

Route::get('/student/AboutUs', function () {
    return Inertia::render('student/AboutUs');
})->middleware(['auth', 'verified'])->name('aboutus');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
