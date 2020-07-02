<?php
Route::get('page/get{type}', 'Content\Controller\Api\ApiController@pageByType');
Route::get('page/{page_id}', 'Content\Controller\Api\ApiController@index')->where('page_id', '[0-9]+');
