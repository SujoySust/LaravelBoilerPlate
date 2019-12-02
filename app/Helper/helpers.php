<?php

use App\Setting;
use Faker\Provider\Image;

function allSetting($array = null)
{
    if (!isset($array[0])) {
        $allSettings = Setting::get();
        if ($allSettings) {
            $output = [];
            foreach ($allSettings as $setting) {
                $output[$setting->slug] = $setting->value;
            }
            return $output;
        }
        return false;
    } elseif (is_array($array)) {
        $allSettings = Setting::whereIn('slug', $array)->get();
        if ($allSettings) {
            $output = [];
            foreach ($allSettings as $setting) {
                $output[$setting->slug] = $setting->value;
            }
            return $output;
        }
        return false;
    } else {
        $allSettings = Setting::where(['slug' => $array])->first();
        if ($allSettings) {
            $output = $allSettings->value;
            return $output;
        }
        return false;
    }
}

/*function fileUpload($new_file, $path, $old_file_name = null, $width = null, $height = null)
{
    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0777, true);
    }
    if (isset($old_file_name) && $old_file_name != "" && file_exists($path . substr($old_file_name, strrpos($old_file_name, '/') + 1))) {

        unlink($path . '/' . substr($old_file_name, strrpos($old_file_name, '/') + 1));
    }

    $input['imagename'] = uniqid() . time() . '.' . $new_file->getClientOriginalExtension();
    $imgPath = public_path($path . $input['imagename']);

    $makeImg = Image::make($new_file);
    if ($width != null && $height != null && is_int($width) && is_int($height)) {
        $makeImg->resize($width, $height);
        $makeImg->fit($width, $height);
    }

    if ($makeImg->save($imgPath)) {
        return $input['imagename'];
    }
    return false;

}*/

function fileUpload($new_file, $path, $old_file_name = null)
{
    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0777, true);
    }
    ini_set('memory_limit','256M');
    $image=$new_file;
    $imageUrl = '';
    if($image){
        $oldImageUrl = $old_file_name;
        if($oldImageUrl){
            unlink($oldImageUrl);
        }
        $imageName = time().'.'.$image->getClientOriginalName();
        $image->move($path,$imageName);
        $imageUrl =$path.$imageName;

    }
    else{

        $imageUrl=$old_file_name;
    }
    return $imageUrl;

}
/* function fileUpload($request){
    $id=Setting::where('slug','COMPANY_LOGO')->first();
    ini_set('memory_limit','256M');
    $productImage=$request->file('logo');
    $imageUrl = '';
    if($productImage){
        $oldImageUrl = $id->value;
        if($oldImageUrl){
            unlink($oldImageUrl);
        }
        $imageName = $productImage->getClientOriginalName();
        $uploadPath ='admin/assets/logo/';
        $productImage->move($uploadPath,$imageName);
        $imageUrl =$uploadPath.$imageName;

    }
    else{

        $imageUrl=$id->value;
    }
    return $imageUrl;


}*/

function path_image()
{
    return 'admin/assets/logo/';
}
