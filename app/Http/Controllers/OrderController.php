<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMode;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('branch_id', getCurrentBranch()->id)->whereDate('order_date', Carbon::today())->orderByDesc('id')->get();
        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mrecord = []; $patient = []; $spectacle = []; $products = Product::all(); $users = User::all(); $pmodes = PaymentMode::all(); $status = OrderStatus::all();
        return view('order.create', compact('mrecord', 'patient', 'spectacle', 'products', 'users', 'pmodes', 'status'));
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
        $mrecord = DB::connection('mysql1')->table('patient_medical_records')->where('id', $request->medical_record_id)->first();
        if($mrecord):
            $patient = DB::connection('mysql1')->table('patient_registrations')->where('id', $mrecord->patient_id)->first();
            $spectacle = DB::connection('mysql1')->table('spectacles')->where('medical_record_id', $request->medical_record_id)->first();
            $products = Product::all(); $users = User::all(); $pmodes = PaymentMode::all(); $status = OrderStatus::all();
            return view('order.create', compact('mrecord', 'patient', 'spectacle', 'products', 'users', 'pmodes', 'status'));
        else:
            return redirect()->back()->with('error', 'No records found')->withInput($request->all());
        endif;
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
        //
    }
}
