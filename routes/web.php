<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/courses', CourseController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/dashboard/users/students', [UserController::class, 'students'])->name('admin.users.students');
    Route::post('/admin/users/{id}/deactivate', [UserController::class, 'deactivate'])->name('admin.users.deactivate');
    Route::get('/dashboard/users/teachers', [UserController::class, 'teachers'])->name('admin.users.teachers');
});

Route::middleware(['auth', 'role:student|teacher'])->group(function () {
    Route::get('/index', [SiteController::class, 'index'])->name('site.index');
});

Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/team', [SiteController::class, 'team'])->name('site.team');
Route::get('/testimonial', [SiteController::class, 'testimonial'])->name('site.testimonial');
Route::get('/about', [SiteController::class, 'about'])->name('site.about');
Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
Route::get('/courses', [SiteController::class, 'courses'])->name('site.courses');
