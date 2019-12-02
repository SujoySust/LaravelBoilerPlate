<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsSettingKey extends Model
{
    //
    protected $guarded = [];
    public function smssetting()
    {
        return $this->belongsTo(SmsSetting::class);
    }
}
