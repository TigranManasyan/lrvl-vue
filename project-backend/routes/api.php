<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', 'AuthController@login')->name('login.api');
Route::get('/current', 'AuthController@current')->name('current.api');
Route::post('/verify', 'AuthController@verify')->name('verify.api');
Route::post('/register','AuthController@register')->name('register.api');
Route::post('/logout', 'AuthController@logout')->name('logout.api');

Route::resource('/products', 'ProductsController');
