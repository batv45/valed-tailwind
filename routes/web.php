<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//region Account
Route::group([ 'middleware' => 'auth' ],function(){
    Route::get('/account',[\App\Http\Controllers\Account\AccountController::class,'show'])->name('account');
    Route::put('/account',[\App\Http\Controllers\Account\AccountController::class,'update'])->name('account.update');
    Route::put('/account/password',[\App\Http\Controllers\Account\AccountController::class,'password'])->name('account.password.update');

    Route::get('/account/settings',[\App\Http\Controllers\Account\SettingController::class,'index'])->name('account.settings');
});
//endregion

//region User
Route::group([ 'middleware' => ['auth', 'verified'] ],function(){
    Route::resource('user',\App\Http\Controllers\User\UserController::class);
});
//endregion



Route::get('/test', function () {
    return Inertia::render('Test');
})->middleware(['auth', 'verified'])->name('test');
