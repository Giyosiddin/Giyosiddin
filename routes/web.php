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
    return view('welcome');
});

Auth::routes(['register' => false]);
Route::group(['middleware' => ['admin']], function() {
    Route::resource('forms', 'FormsController');
    Route::resource('status', 'StatusController');
    Route::resource('test_types', 'TestTypesController');
    Route::resource('exterior_claddings', 'ExteriorCladdingsController');
    Route::resource('internal_claddings', 'InternalCladdingsController');
    Route::resource('roofs', 'RoofController');
    Route::resource('test_speeds', 'TestSpeedController');
    Route::resource('structure_includes', 'StructureIncludesController');
    Route::resource('documents', 'DocumentsController');
//        Route::group(['prefix' => 'forms'], function(){
//
//        });
});
Route::get('/home', 'HomeController@index')->name('home');
