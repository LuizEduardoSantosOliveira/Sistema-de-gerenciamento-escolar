<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login');
})->name('root');


// Rotas para estudantes
Route::middleware(['user.type:student'])->group(function () {
    Route::get('/Student/StudentDashboard', function () {
        return Inertia::render('Student/StudentDashboard');
    })->name('studentdashboard');
    
    // Adicione mais rotas de estudante aqui
});

// Rotas para professores
Route::middleware(['user.type:teacher'])->group(function () {
    Route::get('/Teacher/TeacherDashboard', function () {
        return Inertia::render('Teacher/TeacherDashboard');
    })->name('teacherdashboard');
    
    // Adicione mais rotas de professor aqui
});

// Rotas para administradores
Route::middleware(['user.type:admin'])->group(function () {
    Route::get('/Admin/AdminDashboard', function () {
        return Inertia::render('Admin/AdminDashboard');
    })->name('admindashboard');
    
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';