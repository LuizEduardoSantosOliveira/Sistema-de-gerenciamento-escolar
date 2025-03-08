<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login');
})->name('root');

// routes/web.php

// Rotas de estudante
Route::middleware(['auth', 'verified', 'user.type:student'])->group(function () {
    Route::get('/Student/StudentDashboard', function () {
        return Inertia::render('Student/StudentDashboard');
    })->name('studentdashboard');
    
    Route::get('/Student/Calendar', function () {
        return Inertia::render('Student/Calendar');
    })->name('calendar');
    
    Route::get('/Student/Grades', function () {
        return Inertia::render('Student/Grades');
    })->name('grades');

    Route::get('/Student/Requirements', function () {
        return Inertia::render('Student/Requirements');
    })->name('requiriments');

    Route::get('/Student/AboutUs', function () {
        return Inertia::render('Student/AboutUs');
    })->name('aboutus');
    

    Route::get('/Student/ClassSchedule', function () {
        return Inertia::render('Student/ClassSchedule');
    })->name('classschedule');

    Route::get('/Student/Perfil', function () {
        return Inertia::render('Student/Perfil');
    })->name('perfil');
});

// Rotas de professor
Route::middleware(['auth', 'verified', 'user.type:teacher'])->group(function () {
    Route::get('/Teacher/TeacherDashboard', function () {
        return Inertia::render('Teacher/TeacherDashboard');
    })->name('teacherdashboard');
    
    // ... outras rotas de professor
});

Route::middleware(['auth', 'verified', 'user.type:admin' ])->group(function () {
    Route::get('/Admin/AdminDashboard', function () {
        return Inertia::render('Admin/AdminDashboard');
    })->name('admindashboard');
    
    // ... outras rotas de professor
});






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
