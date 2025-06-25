<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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



Route::get('/', function () {
    return redirect('/dashboard');
});

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::resource('courses', App\Http\Controllers\CourseController::class)->middleware(['auth', 'role:admin']);

Route::get('stripe', [StripeController::class, 'stripe']);
Route::post('stripe', [StripeController::class, 'addMoneyViaStripe'])->name('stripe.post');
Route::get('go-payment', [PayPalController::class, 'goPayment'])->name('payment.go');

Route::get('payment', [PayPalController::class, 'payment'])->name('payment');
Route::get('cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success', [PayPalController::class, 'success'])->name('payment.success');
Route::get('tt', function () {
    return view("google");
});
Route::get("redirectToGoogle", [GoogleController::class, "redirectToGoogle"]);
Route::get("handleGoogleCallback", [GoogleController::class, "handleGoogleCallback"]);
Route::any('/{any}', function ($id) {
    return view("welcome");
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
