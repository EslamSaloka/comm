<?php

Route::get('contact-types', 'Contact\Controller\Api\ApiController@index');
Route::post('contact', 'Contact\Controller\Api\ApiController@store');