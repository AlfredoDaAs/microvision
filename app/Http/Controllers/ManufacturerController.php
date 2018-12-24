<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
	/* ASIC Manufacturer methods */
	public function asic_manufacturer(){
		return view('asic_manufacturer');
	}

	/* Upload confirmation methods */
	public function upload_confirmation(){
		return view('upload_confirmation');
	}
}
