<?php

use Bubalubs\Gravity\Page;

Route::middleware('web')->group(function () {
    Route::get('/page/{slug}', function (string $slug) {
        $page = Page::where('name', $slug)->firstOrFail();

        return view('page', [
            'title' => $page->name,
            'name' => 'Finn', 
            'job' => 'words'
        ]);
    });
    Route::prefix('admin')
        ->namespace('Bubalubs\Gravity\Controllers')
        ->middleware(['auth', 'can:access_admin'])
        ->group(function ()
    {
        Route::get('/', 'DashboardController@view');

        Route::middleware('can:use_tools_in_admin')->group(function () {
            Route::get('pages', 'PagesController@manage');
            Route::get('pages/{page}/fields', 'PageFieldsController@edit');
            Route::get('page-templates', 'PageTemplatesController@manage');
            Route::get('page-templates/{id}/fields', 'PageTemplateFieldsController@edit');
            Route::get('global/fields/manage', 'GlobalContentFieldsController@manage');
            Route::get('entities', 'EntitiesController@manage');
            Route::get('entities/{entity}/fields', 'EntityFieldsController@edit');

            Route::post('pages/create', 'PagesController@create');
            Route::post('entities/create', 'EntitiesController@create');
            Route::post('pages/{page}/fields/create', 'PageFieldsController@create');
            Route::post('page-templates/create', 'PageTemplatesController@create');
            Route::post('page-templates/{id}/fields/create', 'PageTemplateFieldsController@create');
            Route::post('entities/{entity}/fields/create', 'EntityFieldsController@create');
            Route::post('global/fields/create', 'GlobalContentFieldsController@create');
            Route::post('entities/{entity}/fields', 'EntityFieldsController@create');

            Route::delete('pages/{page}/delete', 'PagesController@delete');
            Route::delete('entities/{entity}/delete', 'EntitiesController@delete');
            Route::delete('pages/{page}/fields/{fieldID}/delete', 'PageFieldsController@delete');
            Route::delete('page-templates/{id}/delete', 'PageTemplatesController@delete');
            Route::delete('page-templates/{id}/fields/{fieldID}/delete', 'PageTemplateFieldsController@delete');
            Route::delete('entities/{entity}/fields/{fieldID}/delete', 'EntityFieldsController@delete');
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
            Route::post('pages/{page}/unpublish', 'PageController@unpublish');
            Route::post('pages/{page}/publish', 'PageController@publish');
        });

        Route::middleware('can:edit_global_content_in_admin')->group(function () {
            Route::get('global', 'GlobalContentController@edit');

            Route::post('global/update', 'GlobalContentController@update');
        });

        Route::middleware('can:manage_media_in_admin')->group(function () {
            Route::get('media', 'MediaController@manage');
            Route::get('media/{id}', 'MediaController@edit');

            Route::post('media/create', 'MediaController@create');

            Route::delete('media/{id}/delete', 'MediaController@delete');
        });

        Route::middleware('can:manage_users_in_admin')->group(function () {
            Route::get('users', 'UsersController@manage');
            Route::get('users/{id}', 'UsersController@edit');

            Route::post('users/{id}/update', 'UsersController@update');
        });

        // Local API
        Route::prefix('api')->group(function () {
            Route::middleware('can:use_tools_in_admin')->group(function () {
                Route::get('pages', 'PagesController@getAllPages');
                Route::post('pages/update', 'PagesController@updatePages');
            });

            Route::middleware('can:manage_media_in_admin')->group(function () {
                Route::get('media/images', 'MediaController@getMediaImagesData');
                Route::post('media/images/upload', 'MediaController@uploadImage');
            });
        });
    });
});