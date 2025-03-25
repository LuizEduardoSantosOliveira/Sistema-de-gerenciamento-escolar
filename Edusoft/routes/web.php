<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'status' => session('status'),
        'error' => session('error'),
        'canResetPassword' => Route::has('password.request'),
    ]);
})->name('root');


// Rotas para estudantes
Route::middleware(['user.type:student'])->group(function () {
    Route::get('/Student/StudentDashboard', function () {
        return Inertia::render('Student/StudentDashboard');
    })->name('studentdashboard');


    Route::get('/Student/ClassSchedule', function () {
        return Inertia::render('Student/ClassSchedule');
    })->name('classschedule');

    Route::get('/Student/Requiriments', function () {
        return Inertia::render('Student/Requiriments');
    })->name('requiriments');

});

// Rotas para professores
Route::middleware(['user.type:teacher'])->group(function () {
    Route::get('/Teacher/TeacherDashboard', function () {
        return Inertia::render('Teacher/TeacherDashboard');
    })->name('teacherdashboard');

    Route::get('/Teacher/TeacherClassSchedule', function () {
        return Inertia::render('Teacher/TeacherClassSchedule');
    })->name('teacherclassschedule');

    Route::get('/Teacher/Class', function () {
        return Inertia::render('Teacher/Class');
    })->name('class');

    Route::get('/Teacher/NoteRelease', function () {
        return Inertia::render('Teacher/NoteRelease');
    })->name('noterelease');

    Route::get('/Teacher/Reserve', function () {
        return Inertia::render('Teacher/Reserve');
    })->name('reserve');
    
});

// Rotas para administradores
Route::middleware(['user.type:admin'])->group(function () {
    Route::get('/Admin/AdminDashboard', function () {
        return Inertia::render('Admin/AdminDashboard');
    })->name('admindashboard');

    Route::get('Admin/CalendarManagment', function () {
        return Inertia::render('Admin/CalendarManagment');
    })->name('calendarmanagment');

    Route::get('Admin/GradeManagment', function () {
        return Inertia::render('Admin/GradeManagment');
    })->name('grademanagment');

    Route::get('Admin/RequirimentManagment', function () {
        return Inertia::render('Admin/RequirimentManagment');
    })->name('requirementmanagment');

    Route::get('Admin/ReserveManagment', function () {
        return Inertia::render('Admin/ReserveManagment');
    })->name('reservemanagment');

    Route::get('Admin/UserManagment', function () {
        return Inertia::render('Admin/UserManagment');
    })->name('usermanagment');
    
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/AboutUs', function () {
    return Inertia::render('AboutUs');
})->name('aboutus');

Route::get('/Calendar', function () {
    return Inertia::render('Calendar');
})->name('calendar');


// Verifique se está definido exatamente assim
Route::resource('users', UserController::class)->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';