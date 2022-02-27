<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
     public function productList(Request $request)
    {
        // return $request['category'];

        $search_keyword = $request->keyword;
        $product        = Product::with([
            'category:id,category_name,category_native_name',
            'sub_category:id,sub_category_name,sub_category_native_name',
            'sub_sub_category:id,sub_sub_category_name,sub_sub_category_native_name',
            'brand:id,brand_name,brand_native_name',
            'multiple_image:id,product_id,image_name',
        ])
            ->orderBy('updated_at', 'desc');

        if ($request->category != 'undefined') {
            $product->where('category_id', '=', $request->category);
        }
        if ($request->sub_category != 'undefined') {
            $product->where('sub_category_id', '=', $request->sub_category);
        }

        if ($request->sub_sub_category != 'undefined') {
            $product->where('sub_sub_category_id', '=', $request->sub_sub_category);
        }

        if ($request->brand != 'undefined') {
            $product->where('brand_id', '=', $request->brand);
        }

        if ($request->range != '') {
            $date  = $request->range;
            $data  = explode(",", $date);
            $start = date_convert($data[0]);
            $end   = date_convert($data[1]);
            $product->whereBetween('updated_at', [$start, $end]);
        }

        if ($search_keyword != '') {
            // this three field  or combination doing a and comibination with all other combination in upper
            $product->where(function ($query) use ($search_keyword) {
                $query->where('product_name', 'LIKE', '%' . $search_keyword . '%')
                    ->orWhere('product_native_name', 'LIKE', '%' . $search_keyword . '%')
                    ->orWhere('product_keyword', 'LIKE', '%' . $search_keyword . '%');
            });
        }
        $product = $product->paginate(12);

        return ProductResource::collection($product);

    }
}
