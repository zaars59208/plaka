<?php

Route::group([
    'prefix' => 'signed',
    'middleware' => 'signed',
    'namespace' => 'Modules\Plaka\Http\Controllers'
], function () {
    Route::get('invoices/{invoice}/plaka', 'Payment@signed')->name('signed.invoices.plaka.show');
    Route::post('invoices/{invoice}/plaka/confirm', 'Payment@confirm')->name('signed.invoices.plaka.confirm');
});
