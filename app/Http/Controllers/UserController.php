<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserType;
use Hash;
use DB;
use Session;

class UserController extends Controller
{
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])):
            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            Auth::login($user, $request->get('remember'));
            return redirect()->route('dash')->with("success", "Logged in successfully!");
        endif;  
        return redirect("/")->with('error', 'Login details are not valid')->withInput($request->all());
    }

    public function dash(){
        return view(Auth::user()->usertype->dash);
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
        $roles = UserType::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:users,email',
            'password' => 'required',
            'user_type' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        User::create($input);
        return redirect()->route('user')->with('success', 'User Created Successfully!');
    }

    public function edit($id){
        $user = User::find($id);
        $roles = UserType::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:filter|unique:users,email,'.$id,
            'user_type' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        $user = User::find($id);
        $input['password'] = ($request->password) ? Hash::make($request->password) : $user->getOriginal('password');      
        $user->update($input);
        return redirect()->route('user')->with('success', 'User Updated Successfully!');
    }

    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('user')->with('success', 'User Deleted Successfully!');
    }
}
