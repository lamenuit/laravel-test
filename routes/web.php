<?php

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

/************************************************************************************************
*                                   OPEN ROUTES                                                 *
************************************************************************************************/
Auth::routes();


/************************************************************************************************
*                                   INTERNAL ROUTES                                             *
************************************************************************************************/
Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
});


/************************************************************************************************
*                                   ADMIN ROUTES                                                *
************************************************************************************************/
Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function()
{
   CRUD::resource('tag', 'TagCrudController');
});