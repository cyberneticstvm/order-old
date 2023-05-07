<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockTransfer;
use App\Models\StockTransferDetail;
use App\Models\Subcategory;
use App\Models\Supplier;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockins = StockTransfer::where('transfer_type', 'purchase')->get();
        return view('stockin.index', compact('stockins'));
    }

    public function indexd()
    {
        $stockouts = StockTransfer::where('transfer_type', 'transfer')->get();
        return view('stockout.index', compact('stockouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all(); $categories = Category::orderBy('name')->get();
        return view('stockin.create', compact('suppliers', 'categories'));
    }

    public function created()
    {
        $branches = Branch::all(); $categories = Category::orderBy('name')->get();
        return view('stockout.create', compact('branches', 'categories'));
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
            'supplier_id' => 'required',
            'order_date' => 'required',
            'delivery_date' => 'required',
            'invoice' => 'required',
            'product' => 'present|array',
            'qty' => 'present|array',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        $input['transfer_type'] = 'purchase';
        try{
            DB::transaction(function() use ($input, $request) {
                $stock = StockTransfer::create($input);
                $data = [];
                foreach($request->product as $key => $product):
                    $data [] = [
                        'transfer_id' => $stock->id,
                        'from_branch' => 0,
                        'to_branch' => 0,
                        'transfer_type' => 'purchase',
                        'product_id' => $product,
                        'qty' => $request->qty[$key],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                StockTransferDetail::insert($data);
            });            
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('stockin')->with('success', "Stock added successfully");
    }

    public function stored(Request $request)
    {
        $this->validate($request, [
            'transfer_date' => 'required',
            'from_branch' => 'required',
            'to_branch' => 'required',
            'product' => 'present|array',
            'qty' => 'present|array',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        $input['transfer_type'] = 'transfer';
        try{
            DB::transaction(function() use ($input, $request) {
                $stock = StockTransfer::create($input);
                $data = [];
                foreach($request->product as $key => $product):
                    $data [] = [
                        'transfer_id' => $stock->id,
                        'from_branch' => $request->from_branch,
                        'to_branch' => $request->to_branch,
                        'transfer_type' => 'transfer',
                        'product_id' => $product,
                        'qty' => $request->qty[$key],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                StockTransferDetail::insert($data);
            });            
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('stockout')->with('success', "Stock added successfully");
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
        $stockin = StockTransfer::find(decrypt($id)); $categories = Category::all();
        $subcategories = Subcategory::all(); $products = Product::all(); $suppliers = Supplier::all();
        return view('stockin.edit', compact('stockin', 'categories', 'subcategories', 'products', 'suppliers'));
    }

    public function editd($id)
    {
        $stockout = StockTransfer::find(decrypt($id)); $categories = Category::all();
        $subcategories = Subcategory::all(); $products = Product::all(); $branches = Branch::all();
        return view('stockout.edit', compact('stockout', 'categories', 'subcategories', 'products', 'branches'));
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
            'supplier_id' => 'required',
            'order_date' => 'required',
            'delivery_date' => 'required',
            'invoice' => 'required',
            'product' => 'present|array',
            'qty' => 'present|array',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        try{
            DB::transaction(function() use ($input, $request, $id) {
                $stock = StockTransfer::find($id);
                $stock->update($input);
                $data = [];
                foreach($request->product as $key => $product):
                    $data [] = [
                        'transfer_id' => $stock->id,
                        'from_branch' => 0,
                        'to_branch' => 0,
                        'transfer_type' => 'purchase',
                        'product_id' => $product,
                        'qty' => $request->qty[$key],
                        'created_at' => $stock->created_at,
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                StockTransferDetail::where('transfer_id', $id)->delete();
                StockTransferDetail::insert($data);
            });            
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('stockin')->with('success', "Stock updated successfully");
    }

    public function updated(Request $request, $id)
    {
        $this->validate($request, [
            'transfer_date' => 'required',
            'from_branch' => 'required',
            'to_branch' => 'required',
            'product' => 'present|array',
            'qty' => 'present|array',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        try{
            DB::transaction(function() use ($input, $request, $id) {
                $stock = StockTransfer::find($id);
                $stock->update($input);
                $data = [];
                foreach($request->product as $key => $product):
                    $data [] = [
                        'transfer_id' => $stock->id,
                        'from_branch' => $request->from_branch,
                        'to_branch' => $request->to_branch,
                        'transfer_type' => 'transfer',
                        'product_id' => $product,
                        'qty' => $request->qty[$key],
                        'created_at' => $stock->created_at,
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                StockTransferDetail::where('transfer_id', $id)->delete();
                StockTransferDetail::insert($data);
            });            
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('stockout')->with('success', "Stock updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StockTransfer::find($id)->delete();
        return redirect()->route('stockin')->with('success', "Stock deleted successfully");
    }

    public function destroyd($id)
    {
        StockTransfer::find($id)->delete();
        return redirect()->route('stockout')->with('success', "Stock deleted successfully");
    }
}
