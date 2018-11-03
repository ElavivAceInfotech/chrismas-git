<?php

namespace App\Http\Controllers\Admin;
use App\Models\Children;
use App\Models\Family;
use App\Models\County;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use DB;
use Session;
class ChildrensController extends Controller
{
    public function index() 
    {
		$countys = County::all();
		$data = Input::all();
		if(!empty($data))
		{
			if(isset($data['name'])){ $name = $data['name']; } else { $name = ""; }
			if(isset($data['age'])){ $age = $data['age']; } else { $age = ""; }
			if(isset($data['gender'])){ $gender = $data['gender']; } else { $gender = ""; }
			if(isset($data['county'])){ $county = $data['county']; } else { $county = ""; }
			
			/*$childrens = Children::where('name', 'like',$name.'%')
								->where('age','like',$age.'%')
								->where('gender','like',$gender.'%')
								->where('county','like',$county.'%')
								->paginate(100);
			*/
			$childrens = DB::table('childrens')
					->Join('family', 'family.id', '=', 'childrens.family_id')
					->Join('county', 'county.id', '=', 'childrens.county')
					->where('childrens.name', 'like',$name.'%')
					->where('childrens.age','like',$age.'%')
					->where('childrens.gender','like',$gender.'%')
					->where('childrens.county','like',$county.'%')
					->where('childrens.deleted_at',NULL)
					->select('childrens.*','family.name as fname','county.name as cname')
					->paginate(100);
					
			if(isset($data['name'])){ $childrens->appends(['name'=> $data['name']]); }
			if(isset($data['age'])){ $childrens->appends(['age'=> $data['age']]); }
			if(isset($data['gender'])){ $childrens->appends(['gender'=> $data['gender']]); }
			if(isset($data['county'])){ $childrens->appends(['county'=> $data['county']]); }
			$childrens->appends(Input::except('page'));
			return view('admin.childrens.index', compact('childrens','countys'));
		}
		else
		{
			//$childrens = Children::paginate(100);
			$childrens = DB::table('childrens')
					->Join('family', 'family.id', '=', 'childrens.family_id')
					->Join('county', 'county.id', '=', 'childrens.county')
					->where('childrens.deleted_at',NULL)
					->select('childrens.*','family.name as fname','county.name as cname')
					->paginate(100);	
			return view('admin.childrens.index', compact('childrens','countys'));
		}
    }
    public function create()
    {
		$familys =Family::all();
        return view('admin.childrens.create', compact('familys'));
    }
	public function store(Request $request)
    {
		
		
		$validator = Validator::make($request->all(),
            [
                //'name'                  => 'required|max:255',
				'name'            => 'required',
				'age'            => 'required',
				'gender'            => 'required',
				'county'            => 'required',
				'race'            => 'required',
				'wishlist1'            => 'required',
            ],
            [
				'name.required' => "Name is required",
				'age.required'   => "Age is required",
				'gender.required'   => "Gender is required",
				'county.required'   => "County is required",
				'race.required'   => "Race is required",
				'wishlist1.required'   => "Wishlist 1 is required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
		
		
		if($request->input('family_id') == null)
		{
			$Family = Family::create(['name' =>$request->input('familyname')]); 
			$family_id = $Family->id;
		}
		else
		{
			$family_id = $request->input('family_id');
		}
		$Children = Children::create([
            'family_id'		=> $family_id,
			'name'       	=> $request->input('name'),
            'age'        	=> $request->input('age'),
            'gender'        => $request->input('gender'),
			'county'		=> $request->input('county'),
			'race'		   	=> $request->input('race'),
			'wishlist1'		=> $request->input('wishlist1'),
			'wishlist2'		=> $request->input('wishlist2'),
			'note'			=> $request->input('note'),
			'shirt_size'	=> $request->input('shirt_size'),
			'pants_size'	=> $request->input('pants_size'),
			'coat_size'		=> $request->input('coat_size'),
			'shoe_size'		=> $request->input('shoe_size'),
			'other'			=> $request->input('other'),	
        ]);
		$notification = array(
            'message' => 'Recipient Add succesfully!', 
            'alert-type' => 'success'
        );
		return redirect()->route('childrens.index')->with($notification);
    }
	public function edit($id)
    {
		$children = Children::findOrFail($id);
		return view('admin.childrens.edit', compact('children'));
    }
	public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(),
            [
                //'name'                  => 'required|max:255',
				'name'            => 'required',
				'age'            => 'required',
				'gender'            => 'required',
				'county'            => 'required',
				'race'            => 'required',
				'wishlist1'            => 'required',
            ],
            [
				'name.required' => "Name is required",
				'age.required'   => "Age is required",
				'gender.required'   => "Gender is required",
				'county.required'   => "County is required",
				'race.required'   => "Race is required",
				'wishlist1.required'   => "Wishlist 1 is required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $children = Children::findOrFail($id);
        $children->update($request->all());
		$notification = array(
            'message' => 'Recipient Edit succesfully!', 
            'alert-type' => 'success'
        );
		return redirect()->route('childrens.index')->with($notification);
    }
	public function show($id)
    {
        $children = Children::findOrFail($id);
		return view('admin.childrens.show', compact('children'));
    }
    public function destroy($id)
    {
        $children = Children::findOrFail($id);
        $children->delete();
		$notification = array(
            'message' => 'Recipient Delete succesfully!', 
            'alert-type' => 'success'
        );
		return redirect()->route('childrens.index')->with($notification);
    }
	public function perma_del(Request $request)
    {
        $ids = $request->ids;
        DB::table("childrens")->whereIn('id',explode(",",$ids))->delete();
		return response()->json(['success'=>"Recipient Deleted successfully."]);
    }
}
