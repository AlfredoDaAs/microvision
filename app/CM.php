<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CM extends Model
{
    protected $table = "CM";
    protected $primaryKey = 'ID';

    public $timestamps = false;

    public function manufacturer_cm() {
    	return $this->belongsToMany('App\Manufacturer', 'ManufacturerCM', 'CMID', 'ManufacturerID');
    }

    public function file_transfers() {
    	return $this->hasMany('App\FileTransfer', 'CMID');
    }
}
