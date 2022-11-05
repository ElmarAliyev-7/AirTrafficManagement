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
            $admin->name    = $request->name;
            $admin->surname = $request->surname;
            $admin->email   = $request->email;

            try {
                if ($files = $request->file('image')) {
                    request()->validate([
                        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);
                    $image_path = public_path('back/uploads'.$admin->image);
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    $destinationPath = public_path('back/uploads/');
                    $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $profileImage);
                    $admin->image = public_path('/back/uploads/'). $profileImage;
                }
                $admin->save();
                return redirect()->back()->with('success', 'Uploaded Successfully !');

            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }
}
