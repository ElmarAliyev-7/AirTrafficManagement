<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function aboutUs(Request $request)
    {
        if($request->isMethod('get'))
        {
            $about_us = AboutUs::first();
            return view('admin.about-us', compact('about_us'));
        }

        if($request->isMethod('put'))
        {
            return 1;
        }
    }
}
