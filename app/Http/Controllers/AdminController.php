<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /* Global FTP address methods */
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

        return redirect()->route('home');
    }

    /* CM Management methods */
    public function cm_management(){
        $user = Auth::user();

        $cms = $user->manufacturer->manufacturer_cm;

    	return view('cm_mgmt', ['cms' => $cms]);
    }

    public function cm_mgmt_new(Request $request){
        return response()->json([
            'status' => 'ok',
            'html' => view('cm.new_input')->render()
        ]);
    }

    public  function cm_mgmt_save(Request $request){
        $rules = [
            'txtName' => 'required|array|filled',
            'txtIncomingFile' => 'required|array|filled'
        ];

        $request->validate($rules);

        $user = Auth::user();
        $manufacturer = $user->manufacturer;

        $cmids = $manufacturer->manufacturer_cm->pluck('ID')->toArray();
        $manufacturer->manufacturer_cm()->detach();
        CM::whereIn('ID', $cmids)->delete();

        $txtNames = $request->txtName;
        $txtIncomingFiles = $request->txtIncomingFile;

        if(sizeof($txtNames) == sizeof($txtIncomingFiles)){
            $count = sizeof($txtNames);
            for ($i=0; $i < $count; $i++) {
                if(!empty($txtNames[$i]) && !empty($txtIncomingFiles[$i])){
                    $cm = new CM;
                    $cm->Description = $txtNames[$i];
                    $cm->IncomingFolder = $txtIncomingFiles[$i];
                    $manufacturer->manufacturer_cm()->save($cm);
                }
            }
        }

        return redirect()->route('home');
    }

    /* Manufacturer Management methods */
    public function manufacturer_mgmt(){
        $manufacturers = Manufacturer::all();
    	return view('manufacturer_mgmt', ['manufacturers' => $manufacturers]);
    }

    /* Manufacturer Access methods */
    public function manufacturer_access(){
    	return view('manufacturer_access');
    }

    /* User Management methods */
    public function user_mgmt(){
    	return view('user_mgmt');
    }
}
