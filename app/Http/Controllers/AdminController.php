<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FTPSetting;
use App\CM;
use App\Manufacturer;
use App\User;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function home(){
    	return view('home');
    }

    public function ftp_address(){
    	$ftpsettings = FTPSetting::all();

    	return view('global_ftp_address', ['ftpsettings' => $ftpsettings]);
    }

    public function update_ftp_settings(Request $request){
        $ftpsettings = FTPSetting::all();
        $rules = [];
        foreach ($ftpsettings as $ftpsetting) {
            $rules[$ftpsetting->SettingName] = 'required';
        }

        $request->validate($rules);

        foreach ($ftpsettings as $ftpsetting) {
            $ftpsetting->SettingValue = $request[$ftpsetting->SettingName];
            $ftpsetting->save();
        }

        return redirect()->route('ftp_address');
    }

    public function cm_management(){
    	return view('cm_mgmt');
    }

    public function manufacturer_mgmt(){
    	return view('manufacturer_mgmt');
    }

    public function manufacturer_access(){
    	return view('manufacturer_access');
    }

    public function user_mgmt(){
    	return view('user_mgmt');
    }
}
