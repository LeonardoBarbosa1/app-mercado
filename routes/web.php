<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('fair');
});

Auth::routes();

Route::get('/change-name', [App\Http\Controllers\ProfileController::class, 'newName'])
    ->name('change-name');
Route::post('/update-name', [App\Http\Controllers\ProfileController::class, 'updateName'])
    ->name('update-name');

Route::get('/change-email', [App\Http\Controllers\ProfileController::class, 'newEmail'])
    ->name('change-email');
Route::post('/update-email', [App\Http\Controllers\ProfileController::class, 'updateEmail'])
    ->name('update-email');

Route::get('/change-password', [App\Http\Controllers\ProfileController::class, 'newPassword'])
    ->name('change-password');
Route::post('/update-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])
    ->name('update-password');

Route::resource('fair',  App\Http\Controllers\FairController::class);

Route::fallback(function(){
    return redirect('fair');
});



