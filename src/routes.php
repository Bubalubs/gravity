<?php

Route::middleware('web')->group(function () {
    Route::prefix('admin')
        ->namespace('Bubalubs\LaravelGravity\Controllers')
        ->middleware('auth')
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

        Route::get('global', 'GlobalContentController@edit');
        Route::get('global/fields/manage', 'GlobalContentController@manageFields');

        Route::post('global/update', 'GlobalContentController@update');
        Route::post('global/fields/create', 'GlobalContentController@createField');

        Route::delete('global/fields/{fieldID}/delete', 'GlobalContentController@deleteField');

        Route::get('users', 'UsersController@manage');
    });

});