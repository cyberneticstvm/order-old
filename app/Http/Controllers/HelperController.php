<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\StockTransferDetail;
use Illuminate\Http\Request;
use DB;
use GuzzleHttp\Handler\Proxy;

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

    public function getProduct(Request $request){
        $tax_per = Product::where('product_code', $request->product)->first()->subcategory->tax_percentage;
        $product = Product::where('product_code', $request->product)->selectRaw("CAST(CASE WHEN $tax_per > 0 THEN round(mrp-((mrp*$tax_per)/100), 2) ELSE mrp END AS DECIMAL(7,2)) AS price_after_tax, $tax_per as tax_percentage, discount_percentage, mrp, id")->first();
        return response()->json($product);
    }

    public function stockinhand(){
        $products = Product::all(); $inputs = []; $stockin = collect(); $transfer = collect(); $sold = collect();
        return view('stockinhand.index', compact('products', 'inputs', 'stockin', 'transfer', 'sold'));
    }

    public function fetchstockinhand(Request $request){
        $this->validate($request, [
            'branch' => 'required',
            'product' => 'required',
        ]);
        $products = Product::all(); $inputs = array($request->branch, $request->product);
        $stockin = StockTransferDetail::where('product_id', $request->product)->where('to_branch', $request->branch)->get();
        $transfer = StockTransferDetail::where('product_id', $request->product)->where('from_branch', $request->branch)->get();
        $sold = OrderDetail::where('product_id', $request->product)->where('branch_id', $request->branch)->get();
        return view('stockinhand.index', compact('products', 'inputs', 'stockin', 'transfer', 'sold'));
    }
}
