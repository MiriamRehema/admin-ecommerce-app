<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Models\User;

use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// Route::resource("users",UserController::class);

// Route::resource("roles",RoleController::class);
// Route::resource("products",ProductController::class);
// Route::resource("orders",OrderController::class);
// Route::resource("categories",CategoryController::class);
// Route::get('orders/{order}/items', [OrderController::class, 'show'])->name('orders.items.show');
// //Route::resource("order-items", OrderItemController::class)->except(['show', 'edit', 'update', 'destroy']);
// Route::resource("service_requests", ServiceRequestController::class);
// Route::resource("services", ServiceController::class);



Route::middleware(['auth'])->group(function () {
    Route::get('settings', function () {
        return redirect()->route('settings.profile');
    })->name('settings');
    Route::get('/dashboard/users', function () {
    if (!auth()->user()->can('user-list')) {
        abort(403);
    }
    return view('dashboard.partials.users');
})->name('dashboard.users');
     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/users', [DashboardController::class, 'users'])->name('dashboard.users');
    Route::get('/dashboard/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');
    Route::get('/dashboard/products', [DashboardController::class, 'products'])->name('dashboard.products');
    Route::get('/dashboard/categories', [DashboardController::class, 'categories'])->name('dashboard.categories');
    Route::redirect('settings', 'settings/profile');
    Route::get('/dashboard/roles', [RoleController::class, 'index'])->name('dashboard.roles');
    Route::get('/user-search', [UserController::class, 'searchUser'])->name('user.search-user');


    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
