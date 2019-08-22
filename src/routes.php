<?php

Route::group(['namespace' => 'Studioone\Mobidram\Http\Controllers', 'prefix' => 'mobidram'], function() {
    Route::get('/', 'MobidramController@index')->name('mobidram');
    Route::get('/redirect', 'MobidramController@redirect')->name('redirect');
});
