<?php

Route::prefix('admin')
    ->namespace('Bubalubs\LaravelGravity\Controllers')
    ->middleware('web')
    ->group(function () 
{
    Route::get('/', 'DashboardController@view');
    Route::get('pages/{page}/fields', 'PageController@editFields');
    Route::get('pages/{page}', 'PageController@edit');
    Route::get('pages', 'PagesController@manage');

    Route::post('pages/create', 'PagesController@create');
    Route::post('pages/{page}/update', 'PageController@update');
    Route::post('pages/{page}/fields/create', 'PageController@createField');

    Route::delete('pages/{id}/delete', 'PagesController@delete');
    Route::delete('pages/{page}/fields/{fieldID}/delete', 'PageController@deleteField');
});
