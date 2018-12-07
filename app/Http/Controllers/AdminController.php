<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FTPSetting;

class AdminController extends Controller
{
	public function __construct()
    {
        //$this->middleware('auth');
    }

    public function home(){
    	return view('home');
    }

    public function ftp_address(){
    	$ftpsettings = FTPSetting::first();
    	if(!$ftpsettings){
    		$ftpsettings = null;
    	}
    	return view('global_ftp_address', ['ftpsettings' => $ftpsettings]);
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
