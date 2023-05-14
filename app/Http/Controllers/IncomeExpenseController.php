<?php

namespace App\Http\Controllers;

use App\Models\IncomeExpense;
use App\Models\IncomeExpenseHead;
use Illuminate\Http\Request;

class IncomeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
        $this->middleware('permission:ie-list|ie-create|ie-edit|ie-delete', ['only' => ['index','show']]);
        $this->middleware('permission:ie-create', ['only' => ['create','store']]);
        $this->middleware('permission:ie-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:ie-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $ies = IncomeExpense::all();
        return view('ie.index', compact('ies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heads = IncomeExpenseHead::all();
        return view('ie.create', compact('heads'));
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
            'date' => 'required',
            'head' => 'required',
            'amount' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        $input['branch_id'] = $request->session()->get('branch');
        IncomeExpense::create($input);
        return redirect()->route('ie')->with('success', 'Record created successfully');
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
        $ie = IncomeExpense::find(decrypt($id));
        $heads = IncomeExpenseHead::all();
        return view('ie.edit', compact('heads', 'ie'));
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
            'date' => 'required',
            'head' => 'required',
            'amount' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        $ie = IncomeExpense::find($id);
        $ie->update($input);
        return redirect()->route('ie')->with('success', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        IncomeExpense::find($id)->delete();
        return redirect()->route('ie')->with('success', 'Record deleted successfully');
    }
}
