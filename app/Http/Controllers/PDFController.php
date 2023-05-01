<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function orderbill($id){
        $order = Order::find($id);
        $pdf = PDF::loadView('/PDFs/order-bill', compact('order'));
        return $pdf->stream($order->order_number.'.pdf');
    }
}
