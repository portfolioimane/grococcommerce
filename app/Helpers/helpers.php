<?php

use App\Model\Setting\InstalltionSetting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Model\Setting\DeliverySlotSetting;
use App\AllStatic;

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

function facebookChat()
{
    return cache()->remember('facebook-setting', 43000, function () {
        return App\Model\Setting\Messenger::orderBy('id', 'desc')->first();
    });
}


function getLocationData()
{
    return App\Model\Setting\ShippingArea::where('status', 1)->get();

}

function getDateSlotSetting()
{
    return DeliverySlotSetting::orderBy('id', 'desc')->first();
}

function generateDateSlot()
{

    $slot_setting = getDateSlotSetting();

    $date_from = date('Y-m-d');

    // if today 11 am is over then time will start from tommorrow
    if ($slot_setting->date_interval > 0) {
        $add_day   = " + " . $slot_setting->date_interval . " days";
        $date_from = date('Y-m-d', strtotime(date('Y-m-d') . $add_day));

    }

    $output      = [];
    $from        = strtotime($date_from);
    $end_add_day = " + " . $slot_setting->date_end . " days";
    $date_to     = date('Y-m-d', strtotime($date_from . $end_add_day));

    do {
        $date = date('Y-m-d', $from);
        array_push($output, $date);

        $from = strtotime('+1 days', $from);
    } while ($date != $date_to);

    return $output;
}

function sideMenu($role_id)
{
    $parent = DB::table('menus')
        ->select(DB::raw('menus.id, menus.name, menus.menu_url, menus.parent_id, menus.icon'))
        ->join('permissions', 'permissions.menu_id', '=', 'menus.id')
        ->where('permissions.role_id', $role_id)
        ->orderBy('menus.president', 'ASC')
        ->where('menus.parent_id', 0)
        ->get();

    $sidmenu = [];
    foreach ($parent as $value) {
        $menus              = [];
        $menus['id']        = $value->id;
        $menus['name']      = $value->name;
        $menus['url']       = $value->menu_url;
        $menus['icon']      = $value->icon;
        $menus['parent_id'] = $value->parent_id;

        if ($value->menu_url != null) {

            $menus['sub_menu'] = [];
        } else {

            $menus['sub_menu'] = subMenu($role_id, $value->id);

        }

        array_push($sidmenu, $menus);

    }

    return $sidmenu;

}

function subMenu($role_id, $id)
{

    return DB::table('menus')
        ->select(DB::raw('menus.id, menus.name, menus.menu_url, menus.parent_id, menus.icon'))
        ->join('permissions', 'permissions.menu_id', '=', 'menus.id')
        ->where('permissions.role_id', $role_id)
        ->where('menus.parent_id', '=', $id)
        ->orderBy('president', 'ASC')
        ->get()->toArray();
}