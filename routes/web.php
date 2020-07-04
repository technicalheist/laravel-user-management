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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout'); 
Route::get('/my-account', 'HomeController@myAccount'); 
Route::post('/my-account', 'HomeController@updateAccount')->name('myaccount'); 

Route::group(['prefix'=>'users'], function(){
    Route::get('/', 'Users@users'); 
    Route::get('/create', 'Users@create'); 
    Route::post('/create', 'Users@create')->name('createUser');
    Route::get('/edit/{id}', 'Users@edit'); 
    Route::post('/update', 'Users@update')->name('editUser'); 
    Route::get('/delete/{id}', 'Users@delete'); 
});

Route::group(['prefix'=>'permission'], function(){
    Route::get('/', 'PermissionController@index');
    Route::get('/create', 'PermissionController@create');
    Route::post('/create', 'PermissionController@add')->name('addPermission');
    Route::get('/edit/{id}', 'PermissionController@edit');
    Route::post('/update', 'PermissionController@update')->name('updatePermission');
    Route::get('/delete/{id}', 'PermissionController@delete');
});
