<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user=User::latest()->paginate(4);
        return view('users.index',compact('user'));
    }
    public function create()
    {
      return view('users.create');  
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],
        'mobile'=>['required', 'min:6'],
      ]);
     $user=User::create([
       
       'name'=> $request->name,
       'email'=>$request->email,
       'mobile'=>$request->mobile,
       'password'=>Hash::make($request->password),
    
     ]);
     
     return redirect()->route('users.index')->with('success','user created successfully');
    }
    public function destroy($id)
    {
        
        $user=User::find($id)->delete();
        return redirect()->route('users.index') ;
    }


}
