<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Model\Setting\PaymentSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function paymentMethodList()
    {

        $payment_gateway = PaymentSetting::all();

        return $payment_gateway;
    }

    public function frontMethodList()
    {
        // taking all active payment method list without cash on delivery method
        $payment_methods = PaymentSetting::where('status', '=', 1)
            ->where('id', '!=', 1)
            ->get();

            return $payment_methods;

    }
}
