<?php

namespace App\Http\Controllers\Front\User;

use App\Http\Controllers\Controller;
use App\Model\Coupon\Coupon;
use App\Model\Coupon\UserCoupon;
use App\Model\Order\Order;
use App\Model\Order\OrderDetails;
use App\Model\Order\TrialProduct;
use App\Model\Setting\ShopSetting;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Image;
use PDF;
use Session;
use \Mail;


class UserController extends Controller
{
       public function index()
    {
        return view('front.user.dashboard');
    }

}
