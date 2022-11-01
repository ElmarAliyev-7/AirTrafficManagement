<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $admin;

    public function __construct()
    {
        $this->admin = Auth::guard('admin');
    }

    public function index(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.auth.login');
        }

        if($request->isMethod('post'))
        {
           $auth = $this->admin->attempt([
              'email'   => $request->email,
              'password'=> $request->password,
           ]);

           if($auth){
               return redirect()->route('admin.dashboard')
                   ->with('success', 'Xoşgəldiniz '.$this->admin->user()->name.' '.$this->admin->user()->surname);
           }
           return redirect()->back()->with('error', 'Email və ya parol səhvdir .');
        }
    }

    public function logOut()
    {
        $this->admin->logout();
        return redirect()->route('admin.login')->with('info', 'Logged out');
    }

    public function profile(Request $request)
    {
        if($request->isMethod('get'))
        {
            $admin = $this->admin->user();
            return view('admin.auth.profile',compact('admin'));
        }

        if($request->isMethod('put'))
        {
//            $request->whenHas('password', function ($input) {
//                return redirect()->back()->with('warning', 'Password and Confirm Password doesn\'t match');
//            });
//            return  redirect()->back()->with('success', 'dsad');
        }
    }
}
