<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Route::get('/users/active-austrians', [\App\Http\Controllers\UserController::class, 'getActiveAustrians']);
Route::put('/users/{user}/edit-details', [\App\Http\Controllers\UserController::class, 'updateDetails']);
Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy']);

