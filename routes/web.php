<?php

use App\Models\Order;
use App\Enums\UserTypeEnum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\UsersBrowseController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfferCatalogController;

Route::get('/', [PagesController::class,'index'])->name('welcome');

// User Login/Register
Route::get('/login', [UserController::class,'index']);

// User actions
Route::post('/user/switch-user-type', [UserController::class,'swichUserType'])->name('switch.user.type')->middleware('auth');

Route::post('/register', [UserController::class,'store'])->name('register');
Route::post('/login', [UserController::class, 'authenticate'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

// Users own profile
Route::get('/profile', [UserController::class,'show'])->name('profile.show')->middleware('auth');
Route::get('/profile/edit', [UserController::class,'showEdit'])->name('profile.showEdit')->middleware('auth');
Route::post('/profile', [UserController::class,'edit'])->name('profile.edit')->middleware('auth');
// Sellers only
Route::get('/profile/offers', [UserController::class,'offers'])->name('profile.offers')->middleware('auth');
Route::get('/profile/offers/add', [OfferController::class,'create'])->name('profile.offers.add')->middleware('auth');
Route::post('/profile/offers/add', [OfferController::class,'store'])->name('profile.offers.store')->middleware('auth');
Route::delete('/profile/offers/destroy/{id}', [OfferController::class,'destroy'])->name('profile.offers.destroy')->middleware('auth');

// Users profiles
Route::get('/profile/browse/{username}', [UsersBrowseController::class,'show'])->name('user.show');
Route::get('/profile/browse/{username}/offers', [UsersBrowseController::class,'offers'])->name('user.offer');
Route::get('/profile/browse/{username}/opinions', [UsersBrowseController::class,'opinions'])->name('user.opinion');

// Offers
Route::get('/offers/{category}', [OfferCatalogController::class,'index'])->name('catalog.index');
Route::get('/offer/{id}', [OfferCatalogController::class,'showSingle'])->name('catalog.showSingle');

// Newsletter
Route::post('/newsletter', [NewsletterController::class,'addUser'])->name('newsletter');

// Notifications
Route::get('/profile/notifications', [NotificationController::class,'index'])->name('show.notifications')->middleware('auth');
Route::get('/notifications/read/{id}', [NotificationController::class,'readNotification'])->name('read.notifications')->middleware('auth');

// Chat
Route::post('/chat/create', [ChatController::class,'create'])->name('chat.create')->middleware('auth');
Route::get('/profile/chat/{id}', [ChatController::class,'index'])->name('profile.chat')->middleware('auth');
Route::get('/profile/chat', [ChatController::class,'empty'])->name('profile.chat.empty')->middleware('auth');
Route::post('/chat/send', [ChatController::class,'sendMessage'])->name('chat.send')->middleware('auth');
Route::get('/chat/get', [ChatController::class,'getMessages'])->name('chat.get')->middleware('auth');

// Order
Route::post('/order/create/{id}', [OrderController::class,'createOrder'])->name('create.order')->middleware('auth');
Route::get('/order/show/{id}', [OrderController::class,'getOrderInfo'])->name('orders.info')->middleware('auth');

Route::get('/profile/orders', [OrderController::class,'index'])->name('profile.orders')->middleware('auth');
Route::get('/profile/orders/{id}', [OrderController::class,'singleOrder'])->name('profile.single.order')->middleware('auth');
Route::post('/order/changestatus', [OrderController::class,'changeOrderStatus'])->name('change.order.status')->middleware('auth');
Route::post('/order/pay/{id}', [OrderController::class,'payForOrder'])->name('order.pay')->middleware('auth');

// TODO create better policies