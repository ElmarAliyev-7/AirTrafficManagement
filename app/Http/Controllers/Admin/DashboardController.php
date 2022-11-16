<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Http\Traits\MediaTrait;

class DashboardController extends Controller
{
    use MediaTrait;

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
            try {
                $about_us = AboutUs::first();
                $about_us->title       = $request->title;
                $about_us->description = $request->description;
                $this->mediaDestroy(public_path('back').$about_us->image);
                $about_us->image       = $this->uploadImage(
                    $request->file('image'),
                    public_path('back') ,
                    $about_us->image
                );
                $about_us->save();
                return redirect()->back()->with('success', 'Uploaded Successfully !');

            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }
}
