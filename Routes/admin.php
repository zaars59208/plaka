<?php

Route::group([
    'middleware' => 'admin',
    'namespace' => 'Modules\Plaka\Http\Controllers'
], function () {
    Route::group(['prefix' => 'plaka', 'as' => 'plaka.'], function () {
        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('/', 'Settings@edit')->name('edit');
            Route::post('/', 'Settings@update')->name('update');
            Route::post('get', 'Settings@get')->name('get');
            Route::delete('delete', 'Settings@destroy')->name('delete');
        });
    });
});
