<?php

use App\Models\Branch;
use App\Models\Invoice;
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

?>