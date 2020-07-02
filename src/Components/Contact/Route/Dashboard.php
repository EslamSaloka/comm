<?php
Route::group(['namespace' => 'Contact\Controller\Dashboard'], function () {
   Route::prefix('/contact')->name('contact.')->group(function () {
      Route::resource('type', 'TypeController');
   });
   Route::resource('contact', 'DashboardController');
});
