<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentMode;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Exception;

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
    public function create($medical_record_id)
    {
        $mrecord = DB::connection('mysql1')->table('patient_medical_records')->where('id', $medical_record_id)->first();
        if($mrecord):
            $patient = DB::connection('mysql1')->table('patient_registrations')->where('id', $mrecord->patient_id)->first();
            $spectacle = DB::connection('mysql1')->table('spectacles')->where('medical_record_id', $medical_record_id)->first();
        else:
            $patient = []; $spectacle = [];
        endif;
        $products = Product::all(); $users = User::all(); $pmodes = PaymentMode::all(); $status = OrderStatus::all();
        $categories = Category::all();
        return view('order.create', compact('mrecord', 'patient', 'spectacle', 'products', 'users', 'pmodes', 'status', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'order_date' => 'required|date_format:Y-m-d',
            'patient_name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'expected_delivery_date' => 'required|date_format:Y-m-d',
            'product_advisor' => 'required',
            'order_status' => 'required',
            'order_total' => 'required',
            'total_after_discount' => 'required',
            'tax_amount' => 'required',
            'net_total' => 'required',
            'product' => 'present|array',
        ]);        
        $input = $request->all();
        $input['branch_id'] = session()->get('branch');        
        $input['order_number'] = generateOrderNumber();
        $input['medical_record_id'] = $id;
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;        
        $input['advance_received_at'] = ($request->advance > 0) ? Carbon::now() : NULL;        
        try{
            DB::transaction(function() use ($request, $input) {
                $data = []; $order = Order::create($input);
                foreach($request->product as $key => $val):
                    if($val):
                        $disc = ($request->disc_per[$key] > 0) ? ($request->total[$key]*$request->disc_per[$key])/100 : 0;
                        $tax = ($request->tax_per[$key] > 0) ? (($request->total[$key]-$disc)*$request->tax_per[$key])/100 : 0;
                        $data [] = [
                            'order_id' => $order->id,
                            'branch_id' => getCurrentBranch()->id,
                            'product_type' => $request->type[$key],
                            'sph' => $request->sph[$key],
                            'cyl' => $request->cyl[$key],
                            'axis' => $request->axis[$key],
                            'addition' => $request->add[$key],
                            'product_id' => $val,
                            'qty' => $request->qty[$key],
                            'price' => $request->price[$key],
                            'tax_percentage' => $request->tax_per[$key],
                            'tax_amount' => $tax,
                            'discount_percentage' => $request->disc_per[$key],
                            'discount_amount' => $disc,
                            'total' => $request->total[$key],
                        ];
                    endif;
                endforeach;
                OrderDetail::insert($data);
            });            
        }catch(Exception $e){
            return redirect()->route('order.create', $id)->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('order')->with('success', 'Order created successfully!');
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
            $categories = Category::all();
            return view('order.fetch', compact('mrecord', 'patient', 'spectacle', 'products', 'users', 'pmodes', 'status', 'categories'));
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
        $order = Order::find($id);
        $products = Product::all(); $users = User::all(); $pmodes = PaymentMode::all(); $status = OrderStatus::all();
        $categories = Category::all();
        return view('order.edit', compact('order', 'products', 'users', 'pmodes', 'status', 'categories'));
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
        $this->validate($request, [
            'order_date' => 'required|date_format:Y-m-d',
            'patient_name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'expected_delivery_date' => 'required|date_format:Y-m-d',
            'product_advisor' => 'required',
            'order_status' => 'required',
            'order_total' => 'required',
            'total_after_discount' => 'required',
            'tax_amount' => 'required',
            'net_total' => 'required',
            'product' => 'present|array',
        ]);        
        $input = $request->all(); $order = Order::find($id);
        $input['branch_id'] = $order->getOriginal('branch_id');       
        $input['order_number'] = $order->getOriginal('order_number');
        $input['medical_record_id'] = $order->getOriginal('medical_record_id');
        $input['created_by'] = $order->getOriginal('created_by');
        $input['updated_by'] = $request->user()->id;        
        $input['advance_received_at'] = ($request->advance > 0 && !$order->advance_received_at) ? Carbon::now() : NULL;        
        try{
            DB::transaction(function() use ($request, $input, $order) {
                $data = []; $order->update($input);
                foreach($request->product as $key => $val):
                    if($val):
                        $disc = ($request->disc_per[$key] > 0) ? ($request->total[$key]*$request->disc_per[$key])/100 : 0;
                        $tax = ($request->tax_per[$key] > 0) ? (($request->total[$key]-$disc)*$request->tax_per[$key])/100 : 0;
                        $data [] = [
                            'order_id' => $order->id,
                            'branch_id' => getCurrentBranch()->id,
                            'product_type' => $request->type[$key],
                            'sph' => $request->sph[$key],
                            'cyl' => $request->cyl[$key],
                            'axis' => $request->axis[$key],
                            'addition' => $request->add[$key],
                            'product_id' => $val,
                            'qty' => $request->qty[$key],
                            'price' => $request->price[$key],
                            'tax_percentage' => $request->tax_per[$key],
                            'tax_amount' => $tax,
                            'discount_percentage' => $request->disc_per[$key],
                            'discount_amount' => $disc,
                            'total' => $request->total[$key],
                        ];
                    endif;
                endforeach;
                OrderDetail::where('order_id', $order->id)->delete();
                OrderDetail::insert($data);
            });            
        }catch(Exception $e){
            return redirect()->route('order.create', $id)->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('order')->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect()->route('order')->with('success', 'Order deleted successfully!');
    }
}
