<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;

trait MediaTrait {

    public function uploadImage($request_file, $path ,$old_image)
    {
       if ($files = $request_file) {
           request()->validate([
               'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           ]);
           $image     = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $result    = explode('\AirTrafficManagement\\' ,$path );
           $files->move($path, $image);
           $result[1] = str_replace('\\', '/', $result[1]);
           return $result[1].$image;
       }
       return $old_image;
    }

    public function mediaDestroy($path)
    {
        if(File::exists($path))
        {
            File::delete($path);
        }
    }

}
