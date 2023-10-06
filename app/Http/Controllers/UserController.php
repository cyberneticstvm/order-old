<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserBranch;
use Spatie\Permission\Models\Role;
use Hash;
use DB;
use Session;

class UserController extends Controller
{
    function __construct(){
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])):
            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            Auth::login($user, $request->get('remember'));
            $branches = Branch::whereIn('id', $user->branches->pluck('branch_id'))->where('id', '>', 0)->get();
            return redirect()->route('dash')->with(['branches' => $branches, 'success' => 'User signed in successfully.']);
        endif;  
        return redirect("/")->with('error', 'Login details are not valid')->withInput($request->all());
    }

    public function dash(){
        return view('dash.admin');
    }

    public function store_branch_session(Request $request){
        $this->validate($request, [
            'branch' => 'required',
        ]);
        $request->session()->put('branch', $request->branch);     
        return redirect()->route('dash')->with(['success' => 'Branch updated successfully']);
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/')->with('success','User logged out successfully');
    }

    public function index(){
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create(){
        $roles = Role::pluck('name', 'name')->all();
        $branches = DB::table('branches')->pluck('name', 'id')->all();
        return view('user.create', compact('roles', 'branches'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:users,email',
            'password' => 'required',
            'roles' => 'required',
            'branch' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        $data = [];
        foreach($request->branch as $key => $br):
            $data [] = [
                'user_id' => $user->id,
                'branch_id' => $br,
            ];
        endforeach;
        UserBranch::insert($data);
        return redirect()->route('user')->with('success', 'User Created Successfully!');
    }

    public function edit($id){
        $user = User::find(decrypt($id));
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $branches = DB::table('branches')->pluck('name', 'id')->all();
        $userbranches = DB::table('user_branches')->where('user_id', $id);
        return view('user.edit', compact('user', 'roles', 'userRole', 'branches', 'userbranches'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:users,email,'.$id,
            'roles' => 'required',
            'branch' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $user = User::find($id);
        $input['password'] = ($request->password) ? Hash::make($request->password) : $user->getOriginal('password');      
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        $data = [];
        foreach($request->branch as $key => $br):
            $data [] = [
                'user_id' => $user->id,
                'branch_id' => $br,
            ];
        endforeach;
        DB::table('user_branches')->where('user_id', $id)->delete();
        UserBranch::insert($data);
        return redirect()->route('user')->with('success', 'User Updated Successfully!');
    }

    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('user')->with('success', 'User Deleted Successfully!');
    }
}
