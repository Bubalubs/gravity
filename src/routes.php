<?php

Route::middleware('web')->group(function () {
    Route::prefix('admin')
        ->namespace('Bubalubs\Gravity\Controllers')
        ->middleware(['auth', 'can:access_admin'])
        ->group(function ()
    {
        Route::get('/', 'DashboardController@view');

        Route::middleware('can:use_tools_in_admin')->group(function () {
            Route::get('pages', 'PagesController@manage');
            Route::get('pages/{page}/fields', 'PageFieldsController@edit');
            Route::get('global/fields/manage', 'GlobalContentFieldsController@manage');
            Route::get('entities', 'EntitiesController@manage');
            Route::get('entities/{entity}/fields', 'EntityFieldsController@edit');

            Route::post('pages/create', 'PagesController@create');
            Route::post('entities/create', 'EntitiesController@create');
            Route::post('pages/{page}/fields/create', 'PageFieldsController@create');
            Route::post('entities/{page}/fields/create', 'EntityFieldsController@create');
            Route::post('global/fields/create', 'GlobalContentFieldsController@create');
            Route::post('entities/{entity}/fields', 'EntityFieldsController@create');

            Route::delete('pages/{id}/delete', 'PagesController@delete');
            Route::delete('entities/{id}/delete', 'EntitiesController@delete');
            Route::delete('pages/{page}/fields/{fieldID}/delete', 'PageFieldsController@delete');
            Route::delete('entities/{page}/fields/{fieldID}/delete', 'EntityFieldsController@delete');
            Route::delete('global/fields/{fieldID}/delete', 'GlobalContentFieldsController@delete');
        });

        Route::middleware('can:edit_entities_in_admin')->group(function () {
            Route::get('entities/{entity}', 'EntityController@list');
            Route::get('entities/{entity}/create', 'EntityController@viewCreateForm');
            Route::get('entities/{entity}/{id}', 'EntityController@edit');

            Route::post('entities/{entity}/create', 'EntityController@create');
            Route::post('entities/{entity}/{id}/update', 'EntityController@update');

            Route::delete('entities/{entity}/{id}/delete', 'EntityController@delete');
        });

        Route::middleware('can:edit_page_content_in_admin')->group(function () {
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
    });

});