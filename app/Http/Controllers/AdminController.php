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
        $cms = CM::all();

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

        $txtNames = $request->txtName;
        $txtIncomingFiles = $request->txtIncomingFile;
        $ids = [];

        foreach ($txtNames as $key => $name) {
            if(!empty($name) && !empty($txtIncomingFiles[$key])){
                $cm = CM::where('Description', $name)->first();
                if(!$cm){
                    $cm = new CM;
                    $cm->Description = $name;
                }
                $cm->IncomingFolder = $txtIncomingFiles[$key];
                $cm->save();
                array_push($ids, $cm->ID);
            }
        }

        $otherCMs = CM::whereNotIn('ID', $ids)->get();
        $cantDelete = false;
        foreach ($otherCMs as $key => $cm) {
            if(count($cm->manufacturer_cm) || count($cm->file_transfers)){
                $cantDelete = true;
            }else{
                $cm->delete();
            }
        }

        if($cantDelete){
            return redirect()->back()->withErrors(['msg' => 'Some CMs can not be deleted because of related data']);
        }

        return redirect()->route('cm_management');
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
        $manufacturers = Manufacturer::all();

    	return view('manufacturer_access', ['manufacturers' => $manufacturers]);
    }

    public function manufacturer_access_cms(Request $request){
        $rules = [
            'selected_id' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'status' => 'error'
            ]);
        }

        $manufacturer = Manufacturer::find($request->selected_id);

        $manufacturer_cms = $manufacturer->manufacturer_cm;
        $manufacturer_cmids = $manufacturer_cms->pluck('ID')->toArray();

        $available_cms = CM::whereNotIn('ID', $manufacturer_cmids)->get();

        return response()->json([
            'status' => 'ok',
            'available_cms' => $available_cms->toArray(),
            'asigned_cms' => $manufacturer_cms->toArray()
        ]);
    }

    public function manufacturer_access_save(Request $request){
        $rules = [
            'drpManufacturer' => 'required|numeric',
            'asigned_cms' => 'required|array'
        ];

        $request->validate($rules);

        $manufacturer = Manufacturer::find($request->drpManufacturer);
        $manufacturer->manufacturer_cm()->sync($request->asigned_cms);

        return redirect()->route('manufacturer_access');
    }

    /* User Management methods */
    public function user_mgmt(){
        $users = User::with(['manufacturer', 'status'])->paginate();
        $manufacturers = Manufacturer::all();

    	return view('user_mgmt', ['users' => $users, 'manufacturers' => $manufacturers]);
    }

    public function load_user(Request $request){
        $rules = [
            'user_id' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'status' => 'error'
            ]);
        }

        $user = User::with(['manufacturer', 'status'])->find($request->user_id);
        $user->status_value = ($user->status->Description == config('constants.status.enabled'))? 1 : 0;

        return response()->json([
            'status' => 'ok',
            'user' => $user->toArray()
        ]);
    }

    public function user_mgmt_save(Request $request){
        $rules = [
            'user_id' => 'required|numeric',
            'txtLoginName' => 'required',
            'txtUserName' => 'required',
            'txtEmail' => 'required|email',
            'drpManufacture' => 'required|numeric',
            'txtPassword' => 'required_if:user_id,0|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/'
        ];

        parse_str($request->data, $arrRequest);

        $validator = Validator::make($arrRequest, $rules);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }

        $user_id = $arrRequest['user_id'];
        $manufacturerId = $arrRequest['drpManufacture'];
        $loginName = $arrRequest['txtLoginName'];
        $userName = $arrRequest['txtUserName'];
        $email = $arrRequest['txtEmail'];

        if($user_id){
            $user = User::find($user_id);

            if(!empty($arrRequest['txtPassword'])){
                $user->Password = Hash::make($arrRequest['txtPassword']);
            }
        }else{
            $user = new User;
            $user->Password = Hash::make($arrRequest['txtPassword']);
        }

        $manufacturer = Manufacturer::find($manufacturerId);
        $status = isset($arrRequest['chkStatus'])? 
            Status::where('Description', config('constants.status.enabled'))->first()
            : Status::where('Description', config('constants.status.disabled'))->first();

        if(!$manufacturer){
            return response()->json([
                'status' => 'error',
                'errors' => ['msg' => 'There was an error finding the Manufacturer']
            ]);
        }

        $user->LoginName = $loginName;
        $user->UserName = $userName;
        $user->Email = $email;
        $user->ManufacturerID = $manufacturer->ID;
        $user->StatusID = $status->id;
        $user->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function load_users_card(Request $request){
        $users = User::with(['manufacturer', 'status'])->paginate();
        $users->setPath('/user_management');
        return response()->json([
                'status' => 'ok',
                'html' => view('users.users_card', ['users' => $users])->render()
            ]);
    }

    public function user_mgmt_delete(Request $request){
        $rules = [
            'user_id' => 'required|integer|gt:0'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ]);
        }

        $user = User::find($request->user_id);
        if($user->ID == Auth::user()->ID){
            return response()->json([
                'status' => 'error'
            ]);
        }

        if(count($user->file_transfers)){
            return response()->json([
                'status' => 'error',
                'errors' => ['msg' => 'User can not be deleted because of related data']
            ]);
        }

        $user->delete();

        return response()->json([
            'status' => 'ok'
        ]);
    }
}
