<?php

Route::get('cart-items','Cart\CartController@CartItem');
Route::get('cart/remove/{id}','Cart\CartController@destroy');
Route::get('cart/update/{id}/{status}','Cart\CartController@update');
Route::get('get-shipping','Cart\CartController@shippingAmount');