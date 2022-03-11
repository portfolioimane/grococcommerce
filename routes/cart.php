<?php

Route::get('cart-items','Cart\CartController@CartItem');
Route::get('cart/remove/{id}','Cart\CartController@destroy');
Route::get('cart/update/{id}/{status}','Cart\CartController@update');
Route::get('get-shipping','Cart\CartController@shippingAmount');

Route::group(['middleware' => 'auth'],function(){

Route::get('checkout',['as'=>'checkout.get','uses' => 'Cart\CartController@checkOutPage']);


});