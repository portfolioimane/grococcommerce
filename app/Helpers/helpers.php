<?php

use App\Model\Setting\InstalltionSetting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

function codeCheker()
{
    return $check = InstalltionSetting::orderBy('id', 'desc')->first();
}

function verifyCustomer()
{

    $code = codeCheker();

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => "http://track.limmexbd.com/api/verify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => "",
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => "POST",
        CURLOPT_POSTFIELDS     => array(
            'purchase_code'    => $code->purchase_code,
            'url'              => url('/'),
            'application_name' => 'limmerz',
            'client_ip'        => request()->ip()),
    ));

    $response = curl_exec($curl);

}

function googleAnalytics()
{
    return cache()->remember('google-setting', 43000, function () {
        return App\Model\Setting\GoogleAnalytic::orderBy('id', 'desc')->first();
    });
}


function getCurrentCurrency()
{
    return cache()->remember('currency', 43000, function () {

        return App\Model\Currency::where('currency_status', 1)->first();
    });
}

function frontCategory()
{

    return cache()->remember('all-category', 43000, function () {
        return App\Model\Category::select('id', 'category_name', 'category_native_name', 'icon')
            ->with('sub_category.sub_sub_category')
            ->where('status', '=', 1)
            ->get();
    });

}

function date_convert($data)
{
    $strDate = substr($data, 4, 11);
    $finaldt = date('Y-m-d H:i:s', strtotime($strDate));
    return $finaldt;
}
