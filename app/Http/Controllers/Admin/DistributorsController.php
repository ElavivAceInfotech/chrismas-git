<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Roleuser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Support\Facades\Hash;
use DB;
use Mail;
use Session;
class DistributorsController extends Controller
{
    public function index()
    {
		
		$distributors = DB::table('users')
				->Join('role_user', 'role_user.user_id', '=', 'users.id')
				->where('role_user.role_id','3')
				->where('users.deleted_at',NULL)
				->select('users.*') 
				->paginate(30);
		return view('admin.distributors.index', compact('distributors'));
    }

    public function create()
    {
		return view('admin.distributors.create');
    }

    public function store(Request $request)
    {
		
		$validator = Validator::make($request->all(),
            [
                //'name'                  => 'required|max:255',
				'name'            => 'required',
                'email'                 => 'required|email|max:255|unique:users',
                'password'              => 'required|min:6|max:20|confirmed',
				'password_confirmation' => 'required|same:password',
            ],
            [
				'name.required' => "Name is required",
                'email.required'      => "Email is required",
                'email.email'         => "Email is Invalid",
                'password.required'   => "Password is required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
		
		 $user = User::create([
            'name'             => $request->input('name'),
			'email'            => $request->input('email'),
			'password'         => Hash::make($request->input('password')),
            'token'            => str_random(64),
            'activated'        => 1,
        ]);
		$last_id = $user->id; 
        $user->attachRole('3');
        $user->save(); 
		$email = "test@gmail.com";
		$data['email'] = $request->input('email');
		$data['password'] = $request->input('password');
		Mail::send('emails.registerinfo',['data' => $data], function($message) use($email)
		{
			$message->to($email, 'Christmas Gifts')->subject('Christmas Gifts Login Details');
		});
		$notification = array(
            'message' => 'Distributor Add succesfully!', 
            'alert-type' => 'success'
        );
		return redirect()->route('distributors.index')->with($notification);
    }
	public function edit($id)
    {
        $doners = User::findOrFail($id);

		 $data = [
            'distributors'        => $doners,	
        ];
		return view('admin.distributors.edit')->with($data);
    }
	public function update(Request $request, $id)
    {
		
		$validator = Validator::make($request->all(),
            [
                //'name'                  => 'required|max:255',
				'name'            => 'required',
                'email'                 => 'required|email|max:255',
            ],
            [
				'name.required' => "Name is required",
                'email.required'      => "Email is required",
                'email.email'         => "Email is Invalid",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
		$user = User::find($id);
        $user->name = $request->input('name');
		$user->email = $request->input('email');
        $user->save();
		$notification = array(
            'message' => 'Distributor Edit succesfully!', 
            'alert-type' => 'success'
        );
		return redirect()->route('distributors.index')->with($notification);
    }
	public function show($id)
    {
        $user = User::findOrFail($id);
		return view('admin.distributors.show', compact('user'));
    }
	public function destroy($id)
    {
		$user = User::where('id',$id)->delete();
		$notification = array(
            'message' => 'Distributor delete succesfully!', 
            'alert-type' => 'success'
        );
		return redirect()->route('distributors.index')->with($notification);
    }
	public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
			$ids = $request->ids;
            $entries =  User::whereIn('id',explode(",",$ids))->get();
            foreach ($entries as $entry) {
				$entry->delete();
            }
			return response()->json(['success'=>"Products Deleted successfully."]);
        }
    }

}
