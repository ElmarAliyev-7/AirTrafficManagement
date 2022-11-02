<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

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
            $admin = Admin::find($this->admin->id());
            $admin->update([
                'name'    => $request->name,
                'surname' => $request->surname,
                'email'   => $request->email,
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();
                $fileName = str_random(5)."-".date('his')."-".str_random(3).".".$extension;
                $destinationPath = public_path('back/uploads');
                $file->move($destinationPath, $fileName);
            }

            if($request->password){
                if($request->password == $request->confirm_password){
                    $admin->update([
                        'password'=> Hash::make($request->password),
                    ]);
                    $this->admin->logout();
                    return redirect()->back()->with('info', 'Password Updated Please Loggin again.');
                }
                return redirect()->back()->with('warning', 'Password and Confirm Password doesn\'t match');
            }
            return redirect()->back()->with('success', 'Updated Successfully');
        }
    }
}
