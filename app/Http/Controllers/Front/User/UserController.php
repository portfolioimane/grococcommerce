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
    
    public function storeNewPassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password'    => 'required|confirmed|min:6',
        ]);

        $hasPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hasPassword)) {
            $user           = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            Session::flash('success', 'Password Changed Successfully!');
            return redirect()->route('login');
        } else {
            Session::flash('error', 'Current Password is Invalid!');
            return redirect()->back();
        }
    }

}
