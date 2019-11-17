<?php

Route::prefix('admin')->namespace('Bubalubs\LaravelGravity\Controllers')->group(function () {
    Route::get('/', 'DashboardController@view');
    Route::get('/pages', 'PagesController@manage');
    Route::get('/pages/{page}', 'PageController@edit');

    Route::post('/pages/create', 'PagesController@create');
});
