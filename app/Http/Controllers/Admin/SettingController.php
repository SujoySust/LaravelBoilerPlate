<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Setting;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use test\Mockery\MockingVariadicArgumentsTest;
use DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function update_or_create($slug,$value)
    {
        return Setting::updateOrCreate(['slug'=>$slug],['slug'=>$slug,'value'=>$value]);
    }
    public function index()
    {
        //
        $title = DB::table('settings')->where('slug', 'COMPANY_TITLE')->first();
        $logo = DB::table('settings')->where('slug', 'COMPANY_LOGO')->first();
        $about = DB::table('settings')->where('slug', 'COMPANY_ABOUT')->first();
        $privacy = DB::table('settings')->where('slug', 'COMPANY_PRIVACY')->first();
        $terms = DB::table('settings')->where('slug', 'COMPANY_TERMS_&_CONDITIONS')->first();

        return view('admin.setting.index',['titles'=>$title,'logos'=>$logo,'abouts'=>$about,'privacy'=>$privacy,'terms'=>$terms]);
    }

    // Admin Basic Setting create and update

    public function adminBasicSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }

        if(!empty($request->title))
        {
            $update = $this->update_or_create('COMPANY_TITLE',$request->title);
        }
        if(!empty($request->about))
        {
            $update = $this->update_or_create('COMPANY_ABOUT',$request->about);
        }

        if(!empty($request->terms))
        {
            $update = $this->update_or_create('COMPANY_TERMS',$request->terms);
        }
        if(!empty($request->privacy))
        {
            $update = $this->update_or_create('COMPANY_PRIVACY',$request->privacy);
        }

        if(isset($update))
        {
            return redirect()->back()->with(['success'=>__('Updated Successfully')]);
        }else
        {
            return redirect()->back()->with(['success'=>__('Nothing To Update')]);
        }
    }


    // Admin Image Setting Create and Update

    public function adminImageUploadSave(Request $request)
    {

        $file = $request->file('logo');
        $fileArray = array('image' => $file);

        // Tell the validator that this file should be an image
        $rules = array(
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        );
        // Now pass the input and rules into the validator
        $validator = Validator::make($fileArray, $rules);

        // Check to see if validation fails or passes
        if ($validator->fails())
        {
            // Redirect or return json to frontend with a helpful message to inform the user
            // that the provided file was not an adequate type
            //return response()->json(['error' => $validator->errors()->getMessages()], 400);
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }

       /* $image_url =  fileUpload($file,path_image(),allSetting()['COMPANY_LOGO']);
        return $image_url;*/

        try{
            if(isset($request->logo))
            {
                $id=Setting::where('slug','COMPANY_LOGO')->first();
                $old_image = "";
                if(isset($id))
                {
                    $old_image = $id->value;
                }
               Setting::updateOrCreate(['slug'=>'COMPANY_LOGO'],['slug'=>'COMPANY_LOGO','value'=>fileUpload($request['logo'],path_image(),$old_image)]);
            }

            return redirect()->back()->with(['successImage'=>__('Updated Successfully.')]);

        }catch (\Exception $e){
            return redirect()->back()->with(['dissmissImage'=>__('Nothing To Update')]);

        }

    }

}
