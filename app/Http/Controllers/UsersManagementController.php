<?php
namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\User;
use App\Models\Country; 
use App\Traits\CaptureIpTrait;
use Auth;
use File; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\UrlGenerator;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;
use Image;
class UsersManagementController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pagintaionEnabled = config('usersmanagement.enablePagination');
        if ($pagintaionEnabled) {
            $users = User::paginate(config('usersmanagement.paginateListSize'));
        } else {
            $users = User::all();
        }
        $roles = Role::all();

        return View('usersmanagement.show-users', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        $country = Country::all();
		$data = [
            'roles' => $roles,
			'countrys' => $country,
        ];
		
        return view('usersmanagement.create-user')->with($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                //'name'                  => 'required|max:255',
				'first_name'            => 'required',
                'last_name'             => 'required',
                'email'                 => 'required|email|max:255|unique:users',
				'phone' 				=> 'required|numeric|min:10',
				'country'				=> 'required',
				'gender'				=> 'required',
				'age'					=> 'required|numeric',
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                'role'                  => 'required',
            ],
            [
				'first_name.required' => trans('auth.fNameRequired'),
                'last_name.required'  => trans('auth.lNameRequired'),
                'email.required'      => trans('auth.emailRequired'),
                'email.email'         => trans('auth.emailInvalid'),
                'password.required'   => trans('auth.passwordRequired'),
                'password.min'        => trans('auth.PasswordMin'),
                'password.max'        => trans('auth.PasswordMax'),
                'role.required'       => trans('auth.roleRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();
        $profile = new Profile();

        $user = User::create([
            //'name'             => $request->input('name'),
			'first_name'       => $request->input('first_name'),
            'last_name'        => $request->input('last_name'),
            'email'            => $request->input('email'),
			'phone'			   => $request->input('phone'),
			'country'		   => $request->input('country'),
			'gender'		   => $request->input('gender'),
			'age'			   => $request->input('age'),
            'password'         => bcrypt($request->input('password')),
            'token'            => str_random(64),
            'admin_ip_address' => $ipAddress->getClientIp(),
            'activated'        => 1,
        ]);
		$last_id = $user->id; 
        $user->profile()->save($profile);
        $user->attachRole($request->input('role'));
        $user->save(); 
		
		
		if($request->hasFile('avatar')){
		
			$avatar =  $request->file('avatar');
			$filename = 'avatar.'.$avatar->getClientOriginalExtension();
			$save_path = storage_path().'/users/'.$last_id.'/avatar/';
			$path = $save_path.$filename;
			$public_path = url('/').'/storage/users/'.$last_id.'/avatar/'.$filename;
			File::makeDirectory($save_path, $mode = 0755, true, true);
            Image::make($avatar)->resize(300, 300)->save($save_path.$filename);
			
			$profiledata = array(
            'avatar' => $public_path,
			'avatar_status' => 1,
			);
			$profiledata = Profile::where('user_id',$last_id)->update($profiledata);
		}

        return redirect('admin/users')->with('success', trans('usersmanagement.createSuccess'));
    }

    public function show($id)
    {
        $user = User::find($id);
		if(!empty($user->country))
		{
			$country = Country::find($user->country);
			$user->country = $country->country_name;
        }
		return view('usersmanagement.show-user')->withUser($user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
		$country = Country::all();

        foreach ($user->roles as $user_role) {
            $currentRole = $user_role;
        }

        $data = [
            'user'        => $user,
            'roles'       => $roles,
            'currentRole' => $currentRole,
			'countrys'	  => $country,	
        ];

        return view('usersmanagement.edit-user')->with($data);
    }

    public function update(Request $request, $id)
    {
		
        $currentUser = Auth::user();
        $user = User::find($id);
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);
        $ipAddress = new CaptureIpTrait();

        if ($emailCheck) {
            $validator = Validator::make($request->all(), [
                'password' => 'present|confirmed|min:6',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'password' => 'nullable|confirmed|min:6',
            ]);
        }
		if($request->hasFile('avatar'))
		{
			$avatar =  $request->file('avatar');
			$filename = 'avatar.'.$avatar->getClientOriginalExtension();
			$save_path = storage_path().'/users/'.$id.'/avatar/';
			$path = $save_path.$filename;
			$public_path = url('/').'/storage/users/'.$id.'/avatar/'.$filename;
			File::makeDirectory($save_path, $mode = 0755, true, true);
            Image::make($avatar)->resize(300, 300)->save($save_path.$filename);
			$user->profile->avatar = $public_path;
			$user->profile->avatar_status = 1;
			$user->profile->save();
		}
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
		
        //$user->name = $request->input('name');
		$user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->country = $request->input('country');
		$user->gender = $request->input('gender');
		$user->age = $request->input('age');

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }

        $userRole = $request->input('role');
        if ($userRole != null) {
            $user->detachAllRoles();
            $user->attachRole($userRole);
        }

        $user->updated_ip_address = $ipAddress->getClientIp();

        switch ($userRole) {
            case 3: 
                $user->activated = 0;
                break;

            default:
                $user->activated = 1;
                break;
        }
		
        $user->save();
		return redirect('admin/users');

        //return back()->with('success', trans('usersmanagement.updateSuccess'));
    }

    public function destroy($id)
    {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        if ($user->id != $currentUser->id) {
            $user->deleted_ip_address = $ipAddress->getClientIp();
            $user->save();
            $user->delete();
			return redirect('admin/users');
            //return redirect('users')->with('success', trans('usersmanagement.deleteSuccess'));
        }

        //return back()->with('error', trans('usersmanagement.deleteSelfError'));
		return redirect('admin/users');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('user_search_box');
        $searchRules = [
            'user_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'user_search_box.required' => 'Search term is required',
            'user_search_box.string'   => 'Search term has invalid characters',
            'user_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = User::where('first_name', 'like', $searchTerm.'%')
                            ->orWhere('last_name', 'like', $searchTerm.'%')
							->orWhere('email', 'like', $searchTerm.'%')->get();

        // Attach roles to results
        foreach ($results as $result) {
            $roles = [
                'roles' => $result->roles,
            ];
            $result->push($roles);
        }

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
