<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Traits\MediaTrait;


class AuthController extends Controller
{
    use MediaTrait;

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
            try {
                $admin = Admin::find($this->admin->id());
                $admin->name    = $request->name;
                $admin->surname = $request->surname;
                $admin->email   = $request->email;
                $admin->image   = $this->uploadImage($request->file('image'), $admin->image);
                $admin->save();
                return redirect()->back()->with('success', 'Uploaded Successfully !');

            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }
}
