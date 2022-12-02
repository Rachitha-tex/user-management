<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('user.home');
    Route::post('/','store')->name('user.store');
    Route::get('/user_list','getUsers')->name('user.list');
    Route::get('/edit-user/{id}','editUser')->name('user.edit');
    Route::post('/edit-user/{id}','updateUser')->name('user.update');
    Route::get('/delete-user/{id}','deleteUser');
});