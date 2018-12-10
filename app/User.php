<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "PortalUser";
    protected $primaryKey = 'ID';

    public $timestamps = false;

    protected $fillable = [
        'LoginName', 'UserName', 'Password', 'ManufacturerID', 'Email', 'StatusID'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function manufacturer() {
        return $this->belongsTo('App\Manufacturer', 'ManufacturerID');
    }

    public function is_admin(){
        if($this->manufacturer->is_admin()){
            return true;
        }

        return false;
    }

    public function status() {
        return $this->belongsTo('App\Status', 'StatusID');
    }

    public function file_transfers() {
        return $this->hasMany('App\FileTransfer', 'PortalUserID');
    }

    /**
   * Overrides the method to ignore the remember token.
   */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute)
        {
            parent::setAttribute($key, $value);
        }
    }

}
