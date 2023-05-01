<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\PaymentMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = OrderPayment::orderByDesc('id')->get();
        return view('order.payment.index', compact('payments'));
    }

    public function fetch(Request $request){
        $this->validate($request, [
            'order_number' => 'required',
        ]);
        $order = Order::where('order_number', $request->order_number)->where('order_status', '!=', 5)->first();
        // 5 Means Cancelled Order
        if($order):
            return view('order.payment.proceed', compact('order'));
        else:
            return redirect()->back()->with('error', "No records found")->withInput($request->all());
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $order = Order::find(decrypt($id));
        $pmodes = PaymentMode::all();
        $max = $order->net_total - $order->payments->sum('amount');
        return view('order.payment.create', compact('order', 'pmodes', 'max'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'payment_mode' => 'required',
            'amount' => 'required',
            'payment_date' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        OrderPayment::create($input);
        return redirect()->route('order.payment')->with('success', 'Payment updated successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        OrderPayment::find($id)->delete();
        return redirect()->route('order.payment')->with('success', 'Payment deleted successfully!');
    }
}
