<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\MediaTrait;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use MediaTrait;

    public function create(Request $request)
    {
        if($request->isMethod( 'get'))
        {
            return view('admin.sliders.create');
        }

        if($request->isMethod( 'post'))
        {
            $slider = new Slider();
            $slider->title       = $request->title;
            $slider->description = $request->description;
            $slider->image       = $this->uploadImageToAdmin($request->file('image'));
            $slider->save();
            return redirect()->back()->with('success', 'Slider Created Successfully');
        }
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);

        if($request->isMethod( 'get'))
        {
            return view('admin.sliders.edit', compact('slider'));
        }

        if($request->isMethod( 'put'))
        {
            $slider->title       = $request->title;
            $slider->description = $request->description;
            if($request->file('image')){
                $this->mediaDestroy($slider->image);
            }
            $slider->image = $this->uploadImageToAdmin($request->file('image'), $slider->image);
            $slider->save();
            return redirect()->back()->with('success', 'Slider Update Successfully');
        }
    }

    public function delete($id)
    {
        $slider = Slider::find($id);
        $this->mediaDestroy($slider->image);
        $slider->delete();
        return redirect()->back()->with('success','Slider deleted successfully');
    }

}
