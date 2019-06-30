<?php
Route::middleware(['web', 'auth'])->prefix('/dashboard')->group(function () {
    Route::get('/', 'Tasawk\TasawkComponent\Common\Controller\Dashboard\DashboardController@index')->name('dashboard.Dindex');
    Route::get('/profile', 'Tasawk\TasawkComponent\Common\Controller\Dashboard\DashboardController@profile')->name('dashboard.DProfile.index');
    Route::post('/profile', 'Tasawk\TasawkComponent\Common\Controller\Dashboard\DashboardController@profile')->name('dashboard.DProfile.update');
});
