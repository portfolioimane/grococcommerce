<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Subscribe;

class WebController extends Controller
{
        public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers',
        ]);
        try {
            Subscribe::create($request->all());
            return response()->json(['status' => 'success', 'message' => 'You Subscribed Successfully, Thank You!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMassage()]);
        }

    }
}
