<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/user', 'Api\UserController@currentUser');
    Route::apiResources([
        'users' => 'Api\UserController'
    ]);
    Route::get('/favorites', 'Api\FavoriteController@index')->name('favorites');
    Route::post('/favorites/{id}', 'Api\FavoriteController@favorite');
    Route::post('/unfavorites/{id}', 'Api\FavoriteController@unfavorite');
});

Route::get('/recipes', 'Api\RecipeController@index');
Route::get('/recipes/{id}', 'Api\RecipeController@show');

Route::post('/hooks/ipn', 'Api\HooksController@instantPaymentNotifications');
Route::post('/hooks/lcn', 'Api\HooksController@licenseChangeNotifications');
