<?php

namespace App\Http\Controllers\Doner;
use App\Models\Children;
use App\Models\Family;
use App\Models\County;
use App\Models\Distcenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
class ChildrenslistController extends Controller
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
								->paginate(100);*/
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
			return view('doner.childrens.index', compact('childrens','countys'));
		}
		else
		{
			//$childrens = Children::paginate(100);
			$childrens = DB::table('childrens')
					->Join('family', 'family.id', '=', 'childrens.family_id')
					->Join('county', 'county.id', '=', 'childrens.county')
					->where('childrens.deleted_at',NULL)
					->select('childrens.*','family.name as fname','county.name as cname')
					->paginate(50);
			return view('doner.childrens.index', compact('childrens','countys'));
		}
    }
    public function show($id)
    {
        $children = Children::findOrFail($id);
		return view('doner.childrens.show', compact('children'));
    }
	
	public function sendgift($id)
	{
		$children = Children::where('id',$id)->get();
		$County = County::all();
		return view('doner.childrens.sendgift', compact('children','County'));
	}
	public function sendgifts(Request $request)
	{
		$ids = explode(',',$request->ids);
		$children = DB::table('childrens')
					->Join('county', 'county.id', '=', 'childrens.county')
					->Join('dist_center', 'dist_center.county_id', '=', 'county.id')
					->select('childrens.*','county.id AS cid','county.name AS cname','dist_center.name AS dcname','dist_center.id AS dcid')
					->whereIn('childrens.id',$ids)
					->get();
		$County = County::all();			
		return view('doner.childrens.sendgift', compact('children','County'));
	}
	public function distributed(Request $request)
	{
		
		$dists =  DB::table('county')
					->Join('dist_center', 'dist_center.county_id', '=', 'county.id')
					->where('county.name',$request->ids)
					->select('dist_center.*')
					->get();
		foreach($dists as $dist)
		{
			echo '<option value="'.$dist->name.'">'.$dist->name.'</option>';
		}
	}
}
