<?php
Route::middleware(['web', 'auth'])->prefix('/dashboard')->group(function () {
    Route::get('/', 'Tasawk\TasawkComponent\Common\Controller\Dashboard\DashboardController@index')->name('dashboard.Dindex');
});
