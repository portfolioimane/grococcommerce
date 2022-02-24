<?php
Route::get('enter/code', 'Auth\CodeVerifyController@enterCode')->name('purchase.code');
Route::post('post/code', 'Auth\CodeVerifyController@verifyCode');
Route::get('send-verification', 'Auth\CodeVerifyController@sendVerification');