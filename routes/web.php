<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\UsersBrowseController;
use App\Http\Controllers\OfferCatalogController;

Route::get('/', [PagesController::class,'index'])->name('welcome');

// User Login/Register
Route::get('/login', [UserController::class,'index']);

Route::post('/register', [UserController::class,'store'])->name('register');
Route::post('/login', [UserController::class, 'authenticate'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

// Users own profile
Route::get('/profile', [UserController::class,'show'])->name('profile.show')->middleware('auth');
Route::get('/profile/edit', [UserController::class,'showEdit'])->name('profile.showEdit')->middleware('auth');
Route::post('/profile', [UserController::class,'edit'])->name('profile.edit')->middleware('auth');
Route::get('/profile/offers', [UserController::class,'offers'])->name('profile.offers')->middleware('auth');
Route::get('/profile/offers/add', [OfferController::class,'create'])->name('profile.offers.add')->middleware('auth');
Route::post('/profile/offers/add', [OfferController::class,'store'])->name('profile.offers.store')->middleware('auth');
Route::delete('/profile/offers/destroy/{id}', [OfferController::class,'destroy'])->name('profile.offers.destroy')->middleware('auth');

// Users profiles
Route::get('/profile/browse/{username}', [UsersBrowseController::class,'show'])->name('user.show');
Route::get('/profile/browse/{username}/offers', [UsersBrowseController::class,'offers'])->name('user.offer');

// Offers
Route::get('/offers/{category}', [OfferCatalogController::class,'index'])->name('catalog.index');
Route::get('/offer/{id}', [OfferCatalogController::class,'showSingle'])->name('catalog.showSingle');

// Newsletter
Route::post('/newsletter', [NewsletterController::class,'addUser'])->name('newsletter');