<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\AllStatic;
use App\Model\Brand;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\Product;
use App\Model\Order\Order;
use App\Model\Campaign;

class DashboardController extends Controller
{
    //
     public function index()
    {
        return view('admin.dashboard');
    }

     public function show()
    {
        $stock = Product::sum('current_quantity');
        $category = Category::count();
        $subcategory = SubCategory::count();
        $product = Product::count();
        $customer = User::count();
        $order = Order::count();
        $paidorder = Order::where('payment_status', AllStatic::$paid)->count();
        $unpaidorder = Order::where('payment_status', AllStatic::$not_paid)->count();
        $delivered = Order::where('status', AllStatic::$delivered)->count();
        $ondelivery = Order::where('status', AllStatic::$on_delivery)->count();
        $pendingorder = Order::where('status', AllStatic::$pending)->count();
        $onprocess = Order::where('status', AllStatic::$processing)->count();
        $campaign = Campaign::count();
        return response()->json(['stock' => $stock,'category' => $category,'product' => $product,'order' => $order,'paidorder' => $paidorder,'unpaidorder' => $unpaidorder,'delivered' => $delivered,'ondelivery' => $ondelivery,'pendingorder' => $pendingorder, 'onprocess' => $onprocess, 'subcategory' => $subcategory, 'customer' => $customer, 'campaign' => $campaign]);
    }
}
