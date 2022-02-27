<?php

// uesr and profile related all route will go there

use Illuminate\Support\Facades\Artisan;

Route::group(['middleware' => 'auth'], function () {

    Route::get('profile',
        [
            'as'   => 'user.profile',
            'uses' => 'Front\User\UserController@index',
        ]
    );

    Route::get('profile/logout',
        [
            'as'   => 'user.logout',
            'uses' => 'Front\User\UserController@logout',
        ]
    );

       Route::get('profile/order',
        [
            'as'   => 'user.order',
            'uses' => 'Front\User\UserController@order',
        ]
    );

});

Route::group(['middleware' => 'guest'], function () {

    Route::post('user/reset/password', 'Front\User\UserController@storeResetPassword')->name('user.confirm.password');

});
