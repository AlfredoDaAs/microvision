<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileTransfer extends Model
{
    protected $table = "FileTransfer";
    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $fillable = [
    	'FileName', 'Timestamp', 'Hash', 'ReturnValue', 'ManufacturerID', 'CMID', 'PortalUserID'
    ];

    public function user() {
    	return $this->belongsTo('App\User', 'PortalUserID');
    }

    public function manufacturer() {
    	return $this->belongsTo('App\Manufacturer', 'ManufacturerID');
    }

    public function cm() {
    	return $this->belongsTo('App\CM', 'CMID');
    }
}
