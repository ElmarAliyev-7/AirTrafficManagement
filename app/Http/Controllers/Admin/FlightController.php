<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\MediaTrait;
use App\Models\Flight;
use App\Models\Pilot;
use App\Models\Plane;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    use MediaTrait;

    public function create(Request $request)
    {
        if($request->isMethod( 'get'))
        {
            $pilots = Pilot::get();
            $planes = Plane::get();
            return view('admin.flights.create', compact('pilots', 'planes'));
        }

        if($request->isMethod( 'post'))
        {
            $flight = new Flight();
            $flight->area       = $request->area;
            $flight->date       = $request->date;
            $flight->pilot_id   = $request->pilot_id;
            $flight->plane_id   = $request->plane_id;
            $flight->country_image = $this->uploadImageToAdmin($request->file('image'));
            $flight->save();
            return redirect()->back()->with('success', 'Flight Created Successfully');
        }
    }

    public function update(Request $request, $id)
    {
        $flight = Flight::find($id);

        if($request->isMethod( 'get'))
        {
            $pilots = Pilot::get();
            $planes = Plane::get();
            return view('admin.flights.edit', compact('flight', 'pilots', 'planes'));
        }

        if($request->isMethod( 'put'))
        {
            $flight->area       = $request->area;
            $flight->date       = $request->date;
            $flight->pilot_id   = $request->pilot_id;
            $flight->plane_id   = $request->plane_id;
            if($request->file('image')){
                $this->mediaDestroy($flight->image);
            }
            $flight->country_image = $this->uploadImageToAdmin($request->file('image'), $flight->country_image);
            $flight->save();
            return redirect()->back()->with('success', 'Flight Update Successfully');
        }
    }

    public function delete($id)
    {
        $flight = Flight::find($id);
        $this->mediaDestroy($flight->image);
        $flight->delete();
        return redirect()->back()->with('success','Flight deleted successfully');
    }
}
