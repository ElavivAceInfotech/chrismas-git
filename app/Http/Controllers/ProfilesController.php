<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Theme;
use App\Models\User;
use App\Notifications\SendGoodbyeEmail;
use App\Traits\CaptureIpTrait;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\UrlGenerator;
use Image;
use jeremykenedy\Uuid\Uuid;
use Validator;
use View;
use Auth;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function save(Request $request)
	{
		$currentUser = Auth::user();
        $user = User::find($currentUser->id);
		if($request->hasFile('avatar'))
		{
			$avatar =  $request->file('avatar');
			$filename = 'avatar.'.$avatar->getClientOriginalExtension();
			$save_path = storage_path().'/users/'.$currentUser->id.'/avatar/';
			$path = $save_path.$filename;
			$public_path = url('/').'/storage/users/'.$currentUser->id.'/avatar/'.$filename;
			File::makeDirectory($save_path, $mode = 0755, true, true);
            Image::make($avatar)->resize(300, 300)->save($save_path.$filename);
			$user->profile->avatar = $public_path;
			$user->profile->avatar_status = 1;
			$user->profile->save();
		}
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->country = $request->input('country');
		$user->gender = $request->input('gender');
		$user->age = $request->input('age');
        $user->save();
		return redirect('home');
	}
	
	public function deleteuser()
	{
		
		$currentUser = Auth::user();
        $user = User::findOrFail($currentUser->id);
        $ipAddress = new CaptureIpTrait();

        if ($user->id == $currentUser->id) {
            $user->deleted_ip_address = $ipAddress->getClientIp();
            $user->save();
            $user->delete();
			Auth::logout();
			Session::flush();
			return redirect('login');
            
        }
		return redirect('login');
	}
}
