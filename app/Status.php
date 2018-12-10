<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "Status";
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
    	'Description'
    ];

    public function users() {
    	return $this->hasMany('App\User', 'StatusID');
    }

    public function manufacturers() {
    	return $this->hasMany('App\Manufacturer', 'StatusID');
    }
}
