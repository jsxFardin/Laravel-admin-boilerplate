<?php

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
    return view('auth/login');
});

Auth::routes();


// MIDDLEWARE GROUP
Route::group(['middleware' => ['auth:web']], function () {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
        ->name('dashboard');

    // Route::resource('location', App\Http\Controllers\LocationController::class);
    Route::resource('expense', App\Http\Controllers\Expense\ExpenseController::class);
    Route::get('expense/print/{id}', [App\Http\Controllers\Expense\ExpenseController::class, 'print'])
        ->name('expense.print');
    Route::get('expense/download/{id}', [App\Http\Controllers\Expense\ExpenseController::class, 'download'])
        ->name('expense.download');
    Route::get('expense/approve/{id}/{status}', [App\Http\Controllers\Expense\ExpenseController::class, 'approve'])
        ->name('expense.approve');
    Route::get('expense_autocomplete', [App\Http\Controllers\Expense\ExpenseController::class, 'autocomplete'])
        ->name('expense.autocomplete');

    Route::resource('destination', App\Http\Controllers\DestinationController::class);
    Route::get('location/autocomplete', [App\Http\Controllers\LocationController::class, 'autocomplete'])
        ->name('location.autocomplete');

    Route::resource('settings/role', App\Http\Controllers\Role\RoleController::class);
    Route::resource('settings/user', App\Http\Controllers\User\UserController::class);
    
});
