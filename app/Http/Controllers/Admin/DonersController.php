<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\County;
use App\Models\Roleuser;
use App\Models\Gifttrack;
use App\Models\Ordertrack;
use App\Models\Children;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;
use Mail;
use Session;
class DonersController extends Controller
{
    public function index()
    {
		
		$doners = DB::table('users')
				->Join('role_user', 'role_user.user_id', '=', 'users.id')
				->where('role_user.role_id','2')
				->where('users.deleted_at',NULL)
				->select('users.*')
				->paginate(30);
		return view('admin.doners.index', compact('doners'));
    }

    public function create()
    {
		$county = County::all();
		return view('admin.doners.create',compact('county'));
    }

    public function store(Request $request)
    {
		
		$validator = Validator::make($request->all(),
            [
                //'name'                  => 'required|max:255',
				'name'            => 'required',
                'email'                 => 'required|email|max:255|unique:users',
				'phone' 				=> 'required|numeric',
				'county'				=> 'required',
                'password'              => 'required|min:6|max:20|confirmed',
				'password_confirmation' => 'required|same:password',
            ],
            [
				'name.required' => "Name is required",
                'email.required'      => "Email is required",
                'email.email'         => "Email is Invalid",
				'phone.required'   => "Phone is required",
				'county.required'   => "County is required",
                'password.required'   => "Password is required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
		 $user = User::create([
            'name'             => $request->input('name'),
			'email'            => $request->input('email'),
			'phone'			   => $request->input('phone'),
			'address'		   => $request->input('address'),
			'city'		  	   => $request->input('city'),
			'county'		   => $request->input('county'),
            'password'         => Hash::make($request->input('password')),
            'token'            => str_random(64),
            'activated'        => 1,
        ]);
		$last_id = $user->id; 
        $user->attachRole('2');
        $user->save(); 
		$email = "test@gmail.com";
		$data['email'] = $request->input('email');
		$data['password'] = $request->input('password');
		Mail::send('emails.registerinfo',['data' => $data], function($message) use($email)
		{
			$message->to($email, 'Christmas Gifts')->subject('Christmas Gifts Login Details');
		});
		$notification = array(
            'message' => 'Donor Add succesfully!', 
            'alert-type' => 'success'
        );
		return redirect()->route('doners.index')->with($notification);
    }
	public function edit($id)
    {
        $doners = User::findOrFail($id);
		$county = County::all();
		$data = [
            'doners'        => $doners,	
			'county'		=> $county,
        ];
		return view('admin.doners.edit')->with($data);
    }
	public function update(Request $request, $id)
    {
		
		$validator = Validator::make($request->all(),
            [
                //'name'                  => 'required|max:255',
				'name'            => 'required',
                'email'                 => 'required|email|max:255',
				'phone' 				=> 'required|numeric',
				'county'				=> 'required',
                'password'              => 'required|min:6|max:20|confirmed',
				'password_confirmation' => 'required|same:password',
            ],
            [
				'name.required' => "Name is required",
                'email.required'      => "Email is required",
                'email.email'         => "Email is Invalid",
				'phone.required'   => "Phone is required",
				'county.required'   => "County is required",
                'password.required'   => "Password is required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
		
		$user = User::find($id);
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
		$user->city = $request->input('city');
		$user->county = $request->input('county');
        $user->save();
		$notification = array(
            'message' => 'Donor Edit succesfully!', 
            'alert-type' => 'success'
        );
		return redirect()->route('doners.index')->with($notification);
    }
	public function show($id)
    {
        $user = User::findOrFail($id);
		$county = County::where('id',$user->county)->first();
		return view('admin.doners.show', compact('user','county'));
    }
	public function destroy($id)
    {
		$user = User::where('id',$id)->delete();
		$notification = array(
            'message' => 'Donor Delete succesfully!', 
            'alert-type' => 'success'
        );
		return redirect()->route('doners.index')->with($notification);
    }
	public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
			$ids = $request->ids;
            //$entries = User::whereIn('id', $request->input('ids'))->get();
			$entries =  User::whereIn('id',explode(",",$ids))->get();
            foreach ($entries as $entry) {
				$entry->delete();
            }
			$notification = array(
            'message' => 'Donors Delete succesfully!', 
            'alert-type' => 'success'
			);
			return response()->json(['success'=>"Donors Deleted successfully."]);
        }
    }
	
	public function donergifts($id)
	{
		$gifts = DB::table('order_track') 
				->Join('childrens', 'childrens.id', '=', 'order_track.recipient_id')	
				->where('doner_id',$id)
				->select('order_track.*','childrens.name')
				->paginate(100);	
		return view('admin.doners.donergifts', compact('gifts'));
	}
	
	public function donergiftssingle($id)
	{
		$childrens = DB::table('order_track') 
				->Join('childrens', 'childrens.id', '=', 'order_track.recipient_id')	
				->where('order_track.id',$id)
				->select('order_track.*','childrens.name')
				->get();
			$mainarray = array();	
			foreach($childrens as $child)
			{
				$array = array();
				$array['childname'] = $child->name;
				$array['id'] = $child->doner_id;
				$array['county'] = $child->doner_county;
				$array['dist_center'] = $child->doner_dist_center;
				$array['other_note'] = $child->other_note;	
				$Gifttrack = Gifttrack::where('order_id',$child->id)->get();
				foreach($Gifttrack as $gifts)
				{
					$subarray = array();
					
					$subarray['gift_name'] = $gifts->gift_details;
					$subarray['size'] = $gifts->size;
					$subarray['note'] = $gifts->note;
					$array['gifts'][] = $subarray;
				}	
				$mainarray[] = $array;
			} 
		return view('admin.doners.sendgift', compact('mainarray'));	
	}

}
