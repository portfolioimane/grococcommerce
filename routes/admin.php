<?php

// this file will contain all admin role and permission related route 

Route::group(['prefix'=>'admin','middleware'=>['auth:admin','permission']],function(){
    Route::get('/',[
      'as' => 'admin.dashboard',
      'uses' => 'Dashboard\DashboardController@index',
    ]);

    Route::get('dashboard/summary','Dashboard\DashboardController@show');
    
   
 });
