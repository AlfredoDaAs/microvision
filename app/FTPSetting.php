<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FTPSetting extends Model
{
    protected $table = "FTPSettings";

    protected $fillable = [
    	'SettingName', 'SettingValue'
    ];

    public $timestamps = false;
}
