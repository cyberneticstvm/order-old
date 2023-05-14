<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
        $this->middleware('permission:branch-list|branch-create|branch-edit|branch-delete', ['only' => ['index','show']]);
        $this->middleware('permission:branch-create', ['only' => ['create','store']]);
        $this->middleware('permission:branch-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:branch-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $branches = Branch::all();
        return view('branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branch.create');
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
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required',
            'name' => 'required|unique:branches,name',
            'branch_code' => 'required|unique:branches,branch_code',
        ]);
        $input = $request->all();
        Branch::create($input);
        return redirect()->route('branch')->with('success', 'Branch created successfully');
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
        $branch = Branch::find(decrypt($id));
        return view('branch.edit', compact('branch'));
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
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required',
            'name' => 'required|unique:branches,name,'.$id,
            'branch_code' => 'required|unique:branches,branch_code,'.$id,
        ]);
        $input = $request->all();
        $branch = Branch::find($id);
        $branch->update($input);
        return redirect()->route('branch')->with('success', 'Branch updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::find($id)->delete();
        return redirect()->route('branch')->with('success', 'Branch deleted successfully');
    }
}
