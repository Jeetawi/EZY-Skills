<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

// Dashboard
Route::get('/dashboard', function () {
    return view('backend.pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public Courses
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

Route::middleware('auth')->group(function () {
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Management
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');

    // Course Management (Teachers)
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('courses.my');

    // Enrollment Management (Students)
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('enrollments.enroll');
    Route::get('/my-enrollments', [EnrollmentController::class, 'myEnrollments'])->name('enrollments.my');

    // Enrollment Actions (Teachers)
    Route::post('/enrollments/{enrollment}/accept', [EnrollmentController::class, 'accept'])->name('enrollments.accept');
    Route::post('/enrollments/{enrollment}/reject', [EnrollmentController::class, 'reject'])->name('enrollments.reject');
    Route::get('/enrollments/pending', [EnrollmentController::class, 'pending'])->name('enrollments.pending');

    // Chat Room
    Route::get('/chat', [App\Http\Controllers\ChatRoomController::class, 'index'])->name('chat.index');
    Route::get('/chat/{course}', [App\Http\Controllers\ChatRoomController::class, 'show'])->name('chat.room');

    // Notification Routes
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');

    // Test Notifications Page
    Route::get('/test-notifications', function () {
        return view('test-notifications');
    })->name('test.notifications');
});

require __DIR__.'/auth.php';
