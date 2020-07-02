<?php
Route::get('countries', 'Country\Controller\Api\ApiController@index');
Route::get('countries/{country}/stores', 'Country\Controller\Api\ApiController@stores')->where('country','[0-9]+');
Route::get('countries/{country}/stores/{store}/coupon', 'Country\Controller\Api\ApiController@coupon')->where('country','[0-9]+')->where('store','[0-9]+');