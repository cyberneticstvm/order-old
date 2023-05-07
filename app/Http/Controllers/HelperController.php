<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class HelperController extends Controller
{

    public function createddlcat(){
        $data = DB::table('categories')->select('id', 'name')->get();
        return response()->json($data);
    }

    public function createddl($category){
        $data = DB::table('products')->where('category_id', $category)->select('id', 'name')->get();
        return response()->json($data);
    }

    public function createddlSubCat($category){
        $data = DB::table('subcategories')->where('category_id', $category)->select('id', 'name')->get();
        return response()->json($data);
    }

    public function createddlProduct($subcategory){
        $data = DB::table('products')->where('subcategory_id', $subcategory)->select('id', 'name')->get();
        return response()->json($data);
    }

    public function getProductPrice(Request $request){
        $product = $request->product;
        $tax_per = Product::where('id', $product)->first()->subcategory->tax_percentage;
        $product = Product::where('id', $product)->selectRaw("CAST(CASE WHEN $tax_per > 0 THEN round(mrp-((mrp*$tax_per)/100), 2) ELSE mrp END AS DECIMAL(7,2)) AS price_after_tax, $tax_per as tax_percentage, discount_percentage, mrp")->first();
        return response()->json($product);
    }
}
