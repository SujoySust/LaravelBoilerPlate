<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsSetting extends Model
{
    //
    protected $guarded = [];
    public function smssettingkeys()
    {
        return $this->hasMany(SmsSettingKey::class);
    }
    public function scopeActive($query)
    {
        return $query->where('active',1);
    }
    public function scopeInactive($query)
    {
        return $query->where('active',0);
    }
}
