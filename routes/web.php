<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
//use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::resource("users",UserController::class);
 // This sets up the resource routes with the 'users' name prefix
// Route::resource('permissions',App\Http\Controllers\PermissionController::class)
//     ->middleware(['auth'])
//     ->names('permissions'); // This sets up the resource routes with the 'permissions' name prefix

//Route::middleware(['auth'])->group(function () {
    //Route::resource('permissions', PermissionController::class); // This sets up the resource routes
//});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
