<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class HelperController extends Controller
{
    public function createddl($category){
        $data = DB::table('products')->where('category_id', $category)->select('id', 'name')->get();
        return response()->json($data);
    }

    public function getProductPrice(Request $request){
        $product = $request->product;
        $product = Product::find($product);
        return response()->json($product);
    }
}
