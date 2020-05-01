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
Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/logout', 'Auth\LoginController@logout');

Route::group(['prefix' => config('app.admin_route')], function () {
    Route::group(['middleware' => 'admin_auth'], function() {
        // Main Admin routes
        Route::get('/recipe-maker', 'Admin\AdminController@recipeMaker')->name('voyager.recipe.maker');
    });

    Voyager::routes();
});

Route::view('/{any}', 'app')->where('any', '.*');
