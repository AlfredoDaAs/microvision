<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\CM;
use App\FTPSetting;
use Carbon\Carbon;

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
		/*phpinfo();
		die();*/
		$rules = [
			'cm' => 'required|integer',
			'file' => 'required|file'
		];

		$request->validate($rules);

		$cm = CM::find($request->cm);
		$manufacturer = Auth::user()->manufacturer;
		$ftp_settings = FTPSetting::all();
		$config_ftp = [];

		foreach ($ftp_settings as $key => $ftp_setting) {
			$config_ftp[$ftp_setting->SettingName] = $ftp_setting->SettingValue;
		}

		if($cm && count($config_ftp)){
			//dd($config_ftp);
			$data = [
                     'host'     => '52.91.48.80',//$config_ftp[config('constants.ftp_settings.ftp_host')],
                     'username' => $config_ftp[config('constants.ftp_settings.ftp_admin_usr')],
                     'password' => 'ftp1234',//$config_ftp[config('constants.ftp_settings.ftp_admin_pwd')],
                     'port'     => $config_ftp[config('constants.ftp_settings.ftp_port')],
                     'timeout'  => '30',
                 ];

			if($config_ftp[config('constants.ftp_settings.ftp_port')] == config('constants.ftp_port')){
				$ftp = Storage::createFtpDriver($data);
			}

			if($config_ftp[config('constants.ftp_settings.ftp_port')] == config('constants.sftp_port')){
				$ftp = Storage::createSftpDriver($data);
			}
	 
	        //get file extension
	        $extension = $request->file('file')->getClientOriginalExtension();
	 		
	 		$now = Carbon::now()->format('YmdHis');

	        //filename to store
	        $filenametostore = $cm->IncomingFolder .'/'. $manufacturer->Description .'_'. $cm->Description .'_'. $now .'.'.$extension;
	 
	        //Upload File to external server
	        $ftp->put($filenametostore, fopen($request->file('file'), 'r+'));
	 
	        //Store $filenametostore in the database
		}

		return redirect()->back();
	}

	public function upload_confirmation(){
		return view('upload_confirmation');
	}
}
