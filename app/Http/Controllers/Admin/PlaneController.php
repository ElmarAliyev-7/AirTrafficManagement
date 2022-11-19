<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\MediaTrait;
use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    use MediaTrait;

    public function create(Request $request)
    {
        if($request->isMethod( 'get'))
        {
            return view('admin.planes.create');
        }

        if($request->isMethod( 'post'))
        {
            $plane = new Plane();
            $plane->title    = $request->title;
            $plane->about    = $request->about;
            $plane->image    = $this->uploadImageToAdmin($request->file('image'));
            $plane->save();
            return redirect()->back()->with('success', 'Plane Created Successfully');
        }
    }

    public function update(Request $request, $id)
    {
        $plane = Plane::find($id);

        if($request->isMethod( 'get'))
        {
            return view('admin.Planes.edit', compact('plane'));
        }

        if($request->isMethod( 'put'))
        {
            $plane->title    = $request->title;
            $plane->about    = $request->about;
            if($request->file('image')){
                $this->mediaDestroy($plane->image);
            }
            $plane->image    = $this->uploadImageToAdmin($request->file('image'), $plane->image);
            $plane->save();
            return redirect()->back()->with('success', 'Plane Update Successfully');
        }
    }

    public function delete($id)
    {
        $plane = Plane::find($id);
        $this->mediaDestroy($plane->image);
        $plane->delete();
        return redirect()->back()->with('success','Plane deleted successfully');
    }
}
