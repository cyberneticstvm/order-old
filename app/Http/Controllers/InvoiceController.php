<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct(){
        $this->middleware('permission:invoice-list|invoice-create|invoice-edit|invoice-delete', ['only' => ['index','show']]);
        $this->middleware('permission:invoice-create', ['only' => ['create','store']]);
        $this->middleware('permission:invoice-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:invoice-delete', ['only' => ['destroy']]);
    }

    public function index(){
        $invoices = Invoice::where('status', 0)->whereDate('invoice_date', Carbon::today())->orderByDesc('invoice_date')->get();
        return view('invoice.index', compact('invoices'));
    }

    public function fetch(Request $request){
        $this->validate($request, [
            'order_number' => 'required',
        ]);
        $order = Order::where('order_number', $request->order_number)->whereNull('invoice_generated_at')->where('order_status', '!=', 5)->first();        // 5 Means Cancelled Order
        if($order):
            $sum = OrderPayment::where('order_id', $order->id)->sum('amount');
            return view('invoice.proceed', compact('order', 'sum'));
        else:
            return redirect()->back()->with('error', "No records found / Invoice generated already")->withInput($request->all());
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $order = Order::find(decrypt($id)); $sum = OrderPayment::where('order_id', $order->id)->sum('amount');
        if($order->net_total > $sum):
            return redirect()->back()->with('error', "You cannot generate invoice of an Order with pending payments.");
        else:
            Invoice::create([
                'order_id' => $order->id,
                'invoice_number' => generateInvoiceNumber($order->branch_id),
                'invoice_total' => $order->net_total,
                'invoice_date' => Carbon::now(),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
            Order::where('id', $order->id)->update(['invoice_generated_at' => Carbon::now()]);
            return redirect()->back()->with('success', "Invoice generated successfully.");
        endif;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->validate($request, [
            'medical_record_id' => 'required',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::where('id', $id)->update(['status' => 1]);
        return redirect()->route('invoice')->with('success', 'Invoice cancelled successfully!');
    }
}
