<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\Pilot;
use App\Models\Plane;
use App\Models\Slider;

use App\Http\Traits\MediaTrait;

class DashboardController extends Controller
{
    use MediaTrait;

    public function index()
    {
        $pilots_count = Pilot::count();
        $planes_count = Plane::count();
        return view('admin.dashboard', compact('pilots_count', 'planes_count'));
    }

    public function aboutUs(Request $request)
    {
        $about_us = AboutUs::first();

        if($request->isMethod('get'))
        {
            return view('admin.about-us', compact('about_us'));
        }

        if($request->isMethod('put'))
        {
            try {
                $about_us->title       = $request->title;
                $about_us->description = $request->description;
                if($request->file('image')){
                    $this->mediaDestroy($about_us->image);
                }
                $about_us->image  = $this->uploadImageToAdmin($request->file('image'), $about_us->image);
                $about_us->save();
                return redirect()->back()->with('success', 'Uploaded Successfully !');

            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }

    public function pilots()
    {
        $pilots = Pilot::all();
        return view('admin.pilots.index', compact('pilots'));
    }

    public function planes()
    {
        $planes = Plane::all();
        return view('admin.planes.index', compact('planes'));
    }

    public function sliders()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function flights()
    {
        $flights = Flight::with(['pilot:id,fullname,image', 'plane:id,title,image'])->get();
        return view('admin.flights.index', compact('flights'));
    }

}
