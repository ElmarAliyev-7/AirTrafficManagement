<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait MediaTrait {

    public function uploadImageToAdmin($request_file, $old_image = null)
    {
       if ($files = $request_file) {
           request()->validate([
               'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           ]);
           $filename = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $result   = $files->move(storage_path('app/public/admin/'), $filename);
           $arr      = explode('\app/public/', $result);
           return 'storage\\'.$arr[1];
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
