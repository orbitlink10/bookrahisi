<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PublicSiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicSiteController::class, 'index'])->name('home');
Route::get('/customer/register', [CustomerController::class, 'register'])->name('customer.register');
Route::post('/customer/register', [CustomerController::class, 'registerSubmit'])->name('customer.register.submit');
Route::get('/customer/sign-in', [CustomerController::class, 'signIn'])->name('customer.sign-in');
Route::post('/customer/sign-in', [CustomerController::class, 'signInSubmit'])->name('customer.sign-in.submit');
Route::post('/customer/sign-out', [CustomerController::class, 'signOut'])->name('customer.sign-out');
Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
Route::get('/customer/bookings', [CustomerController::class, 'bookings'])->name('customer.bookings');
Route::post('/customer/bookings/{booking}/cancel', [CustomerController::class, 'cancelBooking'])->name('customer.bookings.cancel');
Route::post('/customer/bookings/{booking}/review', [CustomerController::class, 'submitReview'])->name('customer.bookings.review');
Route::get('/admin/sign-in', [AdminController::class, 'signIn'])->name('admin.sign-in');
Route::post('/admin/sign-in', [AdminController::class, 'signInSubmit'])->name('admin.sign-in.submit');
Route::post('/admin/sign-out', [AdminController::class, 'signOut'])->name('admin.sign-out');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/businesses/{business}/approval', [AdminController::class, 'updateBusinessApproval'])->name('admin.businesses.approval');
Route::post('/admin/users/{user}/status', [AdminController::class, 'updateUserStatus'])->name('admin.users.status');
Route::post('/admin/bookings/{booking}/status', [AdminController::class, 'updateBookingStatus'])->name('admin.bookings.status');
Route::post('/admin/bookings/{booking}/payment', [AdminController::class, 'updateBookingPayment'])->name('admin.bookings.payment');
Route::get('/for-business', [PublicSiteController::class, 'forBusiness'])->name('for-business');
Route::get('/for-business/sign-in', [PublicSiteController::class, 'businessSignIn'])->name('for-business.sign-in');
Route::post('/for-business/sign-in', [PublicSiteController::class, 'businessSignInSubmit'])->name('for-business.sign-in.submit');
Route::get('/for-business/account-setup', [PublicSiteController::class, 'businessAccountSetup'])->name('for-business.account-setup');
Route::post('/for-business/account-setup', [PublicSiteController::class, 'businessAccountSetupSubmit'])->name('for-business.account-setup.submit');
Route::get('/for-business/business-setup', [PublicSiteController::class, 'businessProfileSetup'])->name('for-business.business-setup');
Route::get('/for-business/tools', [PublicSiteController::class, 'businessTools'])->name('for-business.tools');
Route::get('/for-business/tools/bookings', [PublicSiteController::class, 'businessBookings'])->name('for-business.bookings');
Route::get('/for-business/tools/profile', [PublicSiteController::class, 'businessProfileDetails'])->name('for-business.profile-details');
Route::post('/for-business/tools/profile', [PublicSiteController::class, 'businessProfileDetailsSubmit'])->name('for-business.profile-details.submit');
Route::get('/business/{slug}', [PublicSiteController::class, 'publicBusinessProfile'])->name('business.show');
Route::get('/business/{slug}/book', [PublicSiteController::class, 'businessBooking'])->name('business.book');
Route::post('/business/{slug}/book', [PublicSiteController::class, 'businessBookingSubmit'])->name('business.book.submit');
