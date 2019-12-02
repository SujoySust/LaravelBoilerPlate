<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/check',function(){
    return view('admin.home');
});

Route::group(['namespace' => 'Admin'], function(){

    Route::get('/admins','AdminController@index')->name('dashboard');

    //  admin setting route

    Route::get('setting','SettingController@index')->name('setting');
    Route::post('basic-settings-save','SettingController@adminBasicSave')->name('adminBasicSetting');
    Route::post('image-upload-save','SettingController@adminImageUploadSave')->name('adminImageSetting');

    // Admin sms setting

    Route::get('sms-setting','SmsSettingController@index')->name('smsSetting');
    Route::post('sms-setting','SmsSettingController@store')->name('adminSmsSetting');
    Route::post('sms-setting-update','SmsSettingController@update')->name('adminSmsSettingUpdate');
    Route::get('sms-setting-delete/{id}','SmsSettingController@destroy')->name('adminSmsSettingDelete');

    Route::post('sms-setting-key','SmsSettingController@keyStore')->name('adminSmsSettingKey');
    Route::post('sms-setting-key-update','SmsSettingController@updatekeyStore')->name('adminSettingKeyUpdate');
    Route::delete('/sms-setting-key-delete','SmsSettingController@deletekeyStore');


});
