<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\SmsSetting;
use App\SmsSettingKey;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class SmsSettingController extends Controller
{
    //
    public function index()
    {
        $smsLists = SmsSetting::all();
        $smsListKeys = SmsSettingKey::all();
        return view('admin.setting.smsSetting1',compact('smsLists','smsListKeys'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3',
        ]);
        SmsSetting::create($data);
        return redirect()->back()->with(['success'=>__('Saved Successfully')]);
    }

    public function update(Request $request)
    {
//        $key = $request->field_name;
//        $value = $request->field_value;
//        @foreach ()
        SmsSetting::where('id', $request->id)
            ->update(['title' => $request->title,'description' => $request->description]);
        return redirect()->back()->with(['success'=>__('Updated Successfully')]);
    }

    public function destroy($id)
    {
        SmsSetting::where('id',$id)->delete();
        return redirect()->back()->with(['success'=>__('Deleted Successfully')]);
    }

    public function keyStore(Request $request)
    {
//        $titles = $request->field_title;
//        $description = $request->field_descript;
//        $sms_id = $request->sms_id;
//        foreach( $titles as $index => $title ) {
//            SmsSettingKey::create([
//               'slug' => $title,
//               'value' =>$description[$index],
//                'sms_setting_id' => $sms_id
//            ]);
//        }
        SmsSettingKey::create([
            'slug' => $request->slug,
            'value' => $request->value,
            'sms_setting_id' => $request->sms_setting_id
        ]);
        return redirect()->back()->with('success',__('Field Added Successfully'));
    }

    public function updatekeyStore(Request $request)
    {
        $id = $request->id;
        $post = SmsSettingKey::find($id);
        $post->slug = $request->slug;
        $post->value = $request->value;
        $post->save();
        return redirect()->back()->with('success',__('Field Updated Successfully'));

    }
    public function deletekeyStore($request)
    {
        if(isset($request->id)){
            $todo = SmsSettingKey::findOrFail($request->id);
            $todo->delete();
            return 'success';
        }

    }


}
