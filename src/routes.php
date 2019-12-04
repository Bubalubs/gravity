<?php

Route::middleware('web')->group(function () {
    Route::prefix('admin')
        ->namespace('Bubalubs\LaravelGravity\Controllers')
        ->middleware(['auth', 'can:access_admin'])
        ->group(function ()
    {
        Route::get('/', 'DashboardController@view');

        Route::middleware('can:edit_content_in_admin')->group(function () {
            Route::get('pages/{page}', 'PageController@edit');

            Route::post('pages/{page}/update', 'PageController@update');
        });

        Route::middleware('can:edit_global_content_in_admin')->group(function () {
            Route::get('global', 'GlobalContentController@edit');

            Route::post('global/update', 'GlobalContentController@update');
        });

        Route::middleware('can:manage_users_in_admin')->group(function () {
            Route::get('users', 'UsersController@manage');
            Route::get('users/{id}', 'UsersController@edit');

            Route::post('users/{id}/update', 'UsersController@update');
        });

        Route::middleware('can:use_tools_in_admin')->group(function () {
            Route::get('pages', 'PagesController@manage');
            Route::get('pages/{page}/fields', 'PageController@editFields');
            Route::get('global/fields/manage', 'GlobalContentController@manageFields');

            Route::post('pages/create', 'PagesController@create');
            Route::post('pages/{page}/fields/create', 'PageController@createField');
            Route::post('global/fields/create', 'GlobalContentController@createField');

            Route::delete('pages/{id}/delete', 'PagesController@delete');
            Route::delete('pages/{page}/fields/{fieldID}/delete', 'PageController@deleteField');
            Route::delete('global/fields/{fieldID}/delete', 'GlobalContentController@deleteField');
        });
    });

});