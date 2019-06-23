<?php

Route::get('/', 'Common\Controller\Dashboard\DashboardController@index')->name('Dindex');

Route::get('/profile', 'Common\Controller\Dashboard\DashboardController@profile')->name('DProfile.index');
Route::post('/profile', 'Common\Controller\Dashboard\DashboardController@profile_update')->name('DProfile.update');
