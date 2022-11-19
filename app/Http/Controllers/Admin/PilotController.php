<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pilot;

use App\Http\Traits\MediaTrait;

class PilotController extends Controller
{
    use MediaTrait;

    public function create(Request $request)
    {
        if($request->isMethod( 'get'))
        {
            return view('admin.pilots.create');
        }

        if($request->isMethod( 'post'))
        {
            $pilot = new Pilot();
            $pilot->fullname = $request->fullname;
            $pilot->about    = $request->about;
            $pilot->image    = $this->uploadImageToAdmin($request->file('image'));
            $pilot->save();
            return redirect()->back()->with('success', 'Pilot Created Successfully');
        }
    }

    public function update(Request $request, $id)
    {
        $pilot = Pilot::find($id);

        if($request->isMethod( 'get'))
        {
            return view('admin.pilots.edit', compact('pilot'));
        }

        if($request->isMethod( 'put'))
        {
            $pilot->fullname = $request->fullname;
            $pilot->about    = $request->about;
            if($request->file('image')){
                $this->mediaDestroy($pilot->image);
            }
            $pilot->image    = $this->uploadImageToAdmin($request->file('image'), $pilot->image);
            $pilot->save();
            return redirect()->back()->with('success', 'Pilot Update Successfully');
        }
    }

    public function delete($id)
    {
        $pilot = Pilot::find($id);
        $this->mediaDestroy($pilot->image);
        $pilot->delete();
        return redirect()->back()->with('success','Pilot deleted successfully');
    }

}
