<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

use App\FTPSetting;
use App\CM;
use App\Manufacturer;
use App\User;
use App\Status;

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
            $ftpsetting->SettingValue = ($ftpsetting->SettingName == config('constants.ftp_settings.ftp_admin_pwd'))?
                Hash::make($request[$ftpsetting->SettingName]) : $request[$ftpsetting->SettingName];
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

    public function manufacturer_mgmt_new(Request $request){
        $rules = [
            'data_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'status' => 'error'
            ]);
        }

        $data_id = ($request->data_id == null)? 0 : (int)$request->data_id + 1;

        return response()->json([
            'status' => 'ok',
            'html' => view('manufacturer.new_input', ['data_id' => $data_id])->render()
        ]);
    }

    public function manufacturer_mgmt_save(Request $request){
        $rules = [
            'txtDescription' => 'required|array|filled',
            'status' => 'required|array',
            'admin' => 'required|array'
        ];

        $request->validate($rules);

        $ids = [];
        $txtDescriptions = array_values($request->txtDescription);
        $chkStatus = array_values($request->status);
        $chkAdmins = array_values($request->admin);
        $count = sizeof($txtDescriptions);

        for ($i=0; $i < $count; $i++) {
            if(!empty($txtDescriptions[$i])){
                $status = ($chkStatus[$i])?
                    Status::where('Description', config('constants.status.enabled'))->first()
                    : Status::where('Description', config('constants.status.disabled'))->first();
                $isAdmin = ($chkAdmins[$i])? config('constants.manufacturer.is_admin') : config('constants.manufacturer.is_not_admin');
                $manufacturer = Manufacturer::where('Description', $txtDescriptions[$i])->first();
                if(!$manufacturer){
                    $manufacturer = new Manufacturer;
                    $manufacturer->Description = $txtDescriptions[$i];
                }

                $manufacturer->IsAdmin = $isAdmin;
                $manufacturer->StatusID = $status->id;
                $manufacturer->save();

                array_push($ids, $manufacturer->ID);
            }
        }

        $otherMmanufacturers = Manufacturer::whereNotIn('ID', $ids)->get();
        $cantDelete = false;
        foreach ($otherMmanufacturers as $key => $manufac) {
            if(count($manufac->users) || count($manufac->file_transfers) || count($manufac->manufacturer_cm)){
                $cantDelete = true;
            }else{
                $manufac->delete();
            }
        }

        if($cantDelete){
            return redirect()->back()->withErrors(['msg' => 'Some Manufacturers can not be deleted because of related data']);
        }

        return redirect()->route('manufacturer_mgmt');
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
