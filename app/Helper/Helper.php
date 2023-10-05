<?php

use App\Models\Branch;
use App\Models\Invoice;
use App\Models\Lens;
use App\Models\Order;
use Illuminate\Support\Facades\Session;


function getCurrentBranch(){
    return (Session::get('branch')) ? Branch::find(Session::get('branch')) : Branch::find(1);
}

function branches(){
    return Branch::all();
}

function generateOrderNumber(){
    $br = Branch::find(session()->get('branch'));
    $ono = Order::where('branch_id', session()->get('branch'))->selectRaw("IFNULL(MAX(CAST(SUBSTRING_INDEX(order_number, '/', -1) AS SIGNED)+1), 1001) AS orderno")->value('orderno');
    return $br->branch_code.'/'.$ono;
}

function generateProductCode(){
    $key = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($key), 0, 6);
}

function generateInvoiceNumber($branch){
    $br = Branch::find($branch);
    $inv = Invoice::selectRaw("IFNULL(MAX(CAST(SUBSTRING_INDEX(invoice_number, '/', -1) AS SIGNED)+1), 1001) AS inv")->value('inv');
    return 'INV'.'/'.$br->branch_code.'/'.$inv;
}

function checkStockExists($request){
    $product = []; $axis = $request->axis;
    switch($axis):
        case $axis <= 90:
            $axis = [$axis, $axis+90];
            break;
        case $axis > 90:
            $axis = [$axis, $axis-90];
            break;
        default:
            $axis = $axis;
    endswitch;
    $product = Lens::whereIn('axis', $axis)->first();
    return $product;
}

?>