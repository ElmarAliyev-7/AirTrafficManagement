<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;

trait MediaTrait {

    public function uploadImage($request_file ,$img_column)
   {
       if ($files = $request_file) {
           request()->validate([
               'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           ]);
           $image_path = public_path('back/uploads'.$img_column);
           if (File::exists($image_path)) {
               File::delete($image_path);
           }
           $destinationPath = public_path('back/uploads/');
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           return 'back/uploads/'. $profileImage;
       }
       return $img_column;
   }

}
