<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\CM;
use App\FTPSetting;

class ManufacturerController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	/* ASIC Manufacturer methods */
	public function asic_manufacturer(){
		$cms = Auth::user()->manufacturer->manufacturer_cm;

		return view('asic_manufacturer', ['cms' => $cms]);
	}

	public function upload_file(Request $request)
	{
		$rules = [
			'cm' => 'required|integer',
			'file' => 'required|file'
		];

		$request->validate($rules);

		$cm = CM::find($request->cm);
		$ftp_settings = FTPSetting::all();
		$config_ftp = [];

		foreach ($ftp_settings as $key => $ftp_setting) {
			$config_ftp[$ftp_setting->SettingName] = $ftp_setting->SettingValue;
		}

		if($cm && count($config_ftp)){
			if($config_ftp[config('constants.ftp_settings.ftp_port')] == 21){
				$ftp = Storage::createFtpDriver([
                     'host'     => $config_ftp[config('constants.ftp_settings.ftp_host')],
                     'username' => $config_ftp[config('constants.ftp_settings.ftp_admin_usr')],
                     'password' => $config_ftp[config('constants.ftp_settings.ftp_admin_pwd')],
                     'port'     => $config_ftp[config('constants.ftp_settings.ftp_port')],
                     'timeout'  => '30',
                 ]);
			}

			if($config_ftp[config('constants.ftp_settings.ftp_port')] == 22){
				$ftp = Storage::createSftpDriver([
                     'host'     => $config_ftp[config('constants.ftp_settings.ftp_host')],
                     'username' => $config_ftp[config('constants.ftp_settings.ftp_admin_usr')],
                     'password' => $config_ftp[config('constants.ftp_settings.ftp_admin_pwd')],
                     'port'     => $config_ftp[config('constants.ftp_settings.ftp_port')],
                     'timeout'  => '30',
                 ]);
			}

			
		}

		return redirect()->back();
	}

	public function upload_confirmation(){
		return view('upload_confirmation');
	}
}
