<?php

namespace App\Http\Controllers;

use App\Traits\CaptureIpTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\UrlGenerator;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;
use Image;
use DB; 
use Auth;
use File; 
use Carbon\Carbon;

class UploadController extends Controller
{ 
    public function __construct()
    { 
        $this->middleware('auth');
    }
	 
	public function index(Request $request)
    {
		reset($_FILES);
$temp = current($_FILES);
die;
		if($request->hasFile('image'))
		{
			$avatar = $request->file('image');
			$filename = Carbon::now()->format('Ymdhis').'channel.'.$avatar->getClientOriginalExtension();
			$save_path = storage_path().'/channel/';
			$path = $save_path.$filename;
			$public_path = url('/').'/storage/channel/'.$filename;
            Image::make($avatar)->save($save_path.$filename);
		}
    }	
}