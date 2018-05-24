<?php
/************************************************************************************************
*                                   OPEN ROUTES                                                 *
************************************************************************************************/
Auth::routes();

/************************************************************************************************
*                                   INTERNAL ROUTES                                             *
************************************************************************************************/
Route::group(['middleware' => ['FrontAuth'], 'namespace' => 'Front'], function(){
    Route::get('/home', 'HomeController@index')->name('home');

    // Mangas
    Route::group(['prefix' => 'mangas'], function(){
        Route::get('/', 'MangaController@initList')->name('manga-listing');
        Route::get('/{id}-{slug}', 'MangaController@initView')->name('manga-view');
    });

    // AJAX
    Route::group(['prefix' => 'ajax'], function(){
        Route::get('/manga', 'MangaController@ajaxProcess')->name('ajax-manga-get');
    });
});

/************************************************************************************************
*                                   ADMIN ROUTES                                                *
************************************************************************************************/
Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function()
{
    CRUD::resource('manga', 'MangaCrudController');
    CRUD::resource('author', 'AuthorCrudController');
    CRUD::resource('tag', 'TagCrudController');
});