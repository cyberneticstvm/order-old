<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HelperController extends Controller
{
    public function createddl($category){
        $data = DB::table('products')->where('category_id', $category)->select('id', 'name')->get();
        return response()->json($data);
    }
}
