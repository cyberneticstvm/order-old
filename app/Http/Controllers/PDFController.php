<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use PDF;
use QrCode;

class PDFController extends Controller
{
    public function orderBill($id){
        $order = Order::find($id);
        $qrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate('upi://pay?pa=9995050149@okbizaxis&pn='.$order->patient_name.'&tn=DeviOpticians&am='.$order->net_total.'&cu=INR'));
        $pdf = PDF::loadView('/PDFs/order-bill', compact('order', 'qrcode'));
        return $pdf->stream($order->order_number.'.pdf');
    }

    public function paymentReceipt($id){
        $payment = OrderPayment::find($id);
        $pdf = PDF::loadView('/PDFs/payment-receipt', compact('payment'));
        return $pdf->stream($payment->id.'.pdf');
    }

    public function invoice($id){
        $invoice = Invoice::find($id);
        $pdf = PDF::loadView('/PDFs/invoice', compact('invoice'));
        return $pdf->stream($invoice->invoice_number.'.pdf');
    }
}
