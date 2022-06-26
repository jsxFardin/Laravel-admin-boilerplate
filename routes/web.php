<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return view('auth/login');
});
Auth::routes();


// MIDDLEWARE GROUP
Route::group(['middleware' => ['auth:web']], function () {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('settings/role', App\Http\Controllers\Role\RoleController::class)->except('show');
    Route::resource('settings/user', App\Http\Controllers\User\UserController::class)->except('show');
    Route::put('settings/user/change-password/{user}', [App\Http\Controllers\User\UserController::class, 'changePassword'])
        ->name('user.change.password');

    Route::get('/settings/user/profile', [App\Http\Controllers\User\ProfileController::class, 'profile'])
        ->name('user.profile');
    Route::put('/settings/user/profile/{user}', [App\Http\Controllers\User\ProfileController::class, 'update'])
        ->name('profile.update');
});

