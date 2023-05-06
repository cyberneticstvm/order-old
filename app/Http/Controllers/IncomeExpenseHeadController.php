<?php

namespace App\Http\Controllers;

use App\Models\IncomeExpenseHead;
use Illuminate\Http\Request;

class IncomeExpenseHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heads = IncomeExpenseHead::all();
        return view('iehead.index', compact('heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('iehead.create');
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
            'name' => 'required|unique:income_expense_heads,name',
            'type' => 'required',
        ]);
        $input = $request->all();
        $input['created_by'] = $request->user()->id;
        $input['updated_by'] = $request->user()->id;
        IncomeExpenseHead::create($input);
        return redirect()->route('iehead')->with('success', 'Head created successfully');
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
        $head = IncomeExpenseHead::find(decrypt($id));
        return view('iehead.edit', compact('head'));
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
            'name' => 'required|unique:income_expense_heads,name,'.$id,
            'type' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = $request->user()->id;
        $ie = IncomeExpenseHead::find($id);
        $ie->update($input);
        return redirect()->route('iehead')->with('success', 'Head updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        IncomeExpenseHead::find($id)->delete();
        return redirect()->route('iehead')->with('success', 'Head deleted successfully');
    }
}
