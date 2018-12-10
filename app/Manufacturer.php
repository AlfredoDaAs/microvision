<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = "Manufacturer";
    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $fillable = [
    	'Description', 'StatusID', 'IsAdmin'
    ];

    public function status() {
        return $this->belongsTo('App\Status', 'StatusID');
    }

    public function users() {
    	return $this->hasMany('App\User', 'ManufacturerID');
    }

    public function file_transfers() {
    	return $this->hasMany('App\FileTransfer', 'ManufacturerID');
    }

    public function manufacturer_cm() {
    	return $this->belongsToMany('App\CM', 'ManufacturerCM', 'ManufacturerID', 'CMID');
    }

    public function is_admin(){
    	return $this->IsAdmin === 1;
    }
}
