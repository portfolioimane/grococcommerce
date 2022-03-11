<?php

Route::get('payment-method-list','Setting\PaymentSettingController@frontMethodList');
// route for the stripe
	Route::get('stripe/{order_id}',[
		'as' => 'addmoney.stripe',
		'uses' => 'Payment\StripeController@postPaymentStripe'
	]);