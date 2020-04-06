<?php

Route::group([
    'prefix' => 'portal',
    'middleware' => 'portal',
    'namespace' => 'Modules\Plaka\Http\Controllers'
], function () {
    Route::get('invoices/{invoice}/plaka', 'Payment@show')->name('portal.invoices.plaka.show');
    Route::post('invoices/{invoice}/plaka/confirm', 'Payment@confirm')->name('portal.invoices.plaka.confirm');
});
