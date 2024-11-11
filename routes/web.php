<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactUsController;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactUsController::class, 'store'])->name('contact.store');
Route::get('/allServices', [HomeController::class, 'allServices'])->name('allServices');
Route::group(['middleware' => ['auth']], function () {



Route::get('/admin/home', [UserController::class, 'admins'])->name('admin.home');


//profile

Route::get('/profile', [UserController::class, 'userProfile'])->name('profile');
Route::get('/freelancerProfile', [UserController::class, 'freelancerProfile'])->name('freelancerProfile');
Route::post('/profile/update/{id}', [UserController::class, 'updateProfile'])->name('profile.update');


Route::get('/users', [UserController::class, 'users'])->name('users');
Route::get('/freelancers', [UserController::class, 'freelancers'])->name('freelancers');

Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');

Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');



Route::get('/services/order', [ServiceController::class, 'orderDetails'])->name('orderDetails');
Route::post('/services/accept/{id}', [serviceController::class, 'accept'])->name('accept');
Route::post('/services/reject/{id}', [serviceController::class, 'reject'])->name('reject');

Route::get('/services', [ServiceController::class, 'index'])->name('services');

Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');

Route::post('/services/update/{id}', [ServiceController::class, 'update'])->name('services.update');

Route::delete('/services/destroy/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');


Route::get('/users/home', [OrderController::class, 'index'])->name('users.home');


Route::get('/orders', [ServiceController::class, 'order'])->name('order');


Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::post('/booking/respond/{bookingId}', [BookingController::class, 'respondToBooking'])->name('booking.respond');
Route::post('/booking/accept/{id}', [BookingController::class, 'acceptBooking'])->name('booking.accept');
Route::post('/booking/reject/{id}', [BookingController::class, 'rejectBooking'])->name('booking.reject');
Route::post('/booking/cancel/{id}', [BookingController::class, 'cancelBooking'])->name('booking.cancel');
Route::post('/booking/finish/{id}', [BookingController::class, 'finishBooking'])->name('booking.finish');


//order
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::post('/order/accept/{id}', [OrderController::class, 'acceptOrder'])->name('order.accept');
Route::post('/order/reject/{id}', [OrderController::class, 'rejectOrder'])->name('order.reject');
Route::post('/order/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('order.cancel');


Route::get('/contactus', [ContactUsController::class, 'index'])->name('contact.index');


});