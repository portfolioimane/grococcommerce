<?php

Route::group(['prefix'=>'admin','middleware'=>['auth:admin','permission']],function(){

Route::get('category-stock/chart', 'Chart\ReportController@getCatStock');
Route::get('last-month/order/chart', 'Chart\ReportController@getOrderData');
Route::get('last-month/customer/chart', 'Chart\ReportController@getCustomerData');
Route::get('sales-amount/chart', 'Chart\ReportController@getSaleAmount');

});