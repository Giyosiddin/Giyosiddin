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
Route::post('login', 'UserController@authenticate');
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::group(['prefix' => 'project'], function() {
        Route::get('all', 'ProjectsController@getAll');
        Route::get('getInfo', 'ProjectsController@getInfo');
        Route::post('store', 'ProjectsController@store');
        Route::get('{id}', 'ProjectsController@show');
        Route::post('{id}', 'ProjectsController@update');
    });
    Route::group(['prefix' => 'user'], function() {
        Route::get('/', 'UserController@show');
        Route::get('/get', 'UserController@getUsers');
    });
    Route::group(['prefix' => 'area'], function() {
        Route::get('/', 'AreasController@index');
        Route::post('store', 'AreasController@store');
    });
    Route::group(['prefix' => 'profession'], function() {
        Route::get('/', 'ProfessionsController@index');
        Route::post('store', 'ProfessionsController@store');
    });
    Route::group(['prefix' => 'standart'], function() {
        Route::get('/', 'StandartsController@index');
        Route::post('store', 'StandartsController@store');
    });
});
