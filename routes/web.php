<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\ServiceController;


Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::resource("users",UserController::class);

Route::resource("roles",RoleController::class);
Route::resource("products",ProductController::class);
Route::resource("orders",OrderController::class);
Route::resource("categories",CategoryController::class);
Route::get('orders/{order}/items', [OrderController::class, 'show'])->name('orders.items.show');
//Route::resource("order-items", OrderItemController::class)->except(['show', 'edit', 'update', 'destroy']);
Route::resource("service_requests", ServiceRequestController::class);
Route::resource("services", ServiceController::class);



Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
