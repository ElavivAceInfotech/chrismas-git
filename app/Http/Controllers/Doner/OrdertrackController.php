<?php

namespace App\Http\Controllers\Doner;
use App\Models\Gifttrack;
use App\Models\Ordertrack;
use App\Models\County;
use App\Models\Distcenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use DB;
use Auth;
use Session;
class OrdertrackController extends Controller
{
	
	public function index()
    {
		$currentUser = Auth::user();
		$childrens = DB::table('order_track') 
				->Join('childrens', 'childrens.id', '=', 'order_track.recipient_id')	
				->where('doner_id',$currentUser->id)
				->select('order_track.*','childrens.name')
				->paginate(50);	
		return view('doner.gift.index', compact('childrens'));
	}
	
	public function show($id)
    {
			$childrens = DB::table('order_track') 
				->Join('childrens', 'childrens.id', '=', 'order_track.recipient_id')
				->Join('county', 'county.id', '=', 'childrens.county')
				->Join('dist_center', 'dist_center.id', '=', 'childrens.dist_center_id')
				->where('order_track.id',$id)
				->select('order_track.*','childrens.name','county.name AS cname','dist_center.name AS dcname')
				->get();
			$mainarray = array();	
			foreach($childrens as $child)
			{
				$array = array();
				$array['childname'] = $child->name;
				$array['cname'] = $child->cname;
				$array['dcname'] = $child->dcname;
				$array['county'] = $child->doner_county;
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
		return view('doner.gift.sendgift', compact('mainarray'));
    }
	
    public function store(Request $request)
    {
		$currentUser = Auth::user();
		$dataarray = array();
		foreach($request->ids as $dataone)
		{	
			$Ordertrack = Ordertrack::create([
				'doner_id'		=> $currentUser->id,
				'recipient_id'	=> $dataone,
				'doner_county'	=> $request->county,
				'doner_dist_center'	=> $request->doner_dist_center,
				'other_note'		=> $request->other_note,
			]);
			$last_id = $Ordertrack->id;
			$dataarray[] = $last_id;
			foreach($request->giftname[$dataone] as $key => $datatwo)
			{
				$Gifttrack = Gifttrack::create([
				'order_id'		=> $last_id,
				'gift_details'	=> $datatwo,
				'size'	=> $request->size[$dataone][$key],
				'note'	=> $request->note[$dataone][$key],
				]);
			}
		}
		
			$childrens = DB::table('order_track') 
				->Join('childrens', 'childrens.id', '=', 'order_track.recipient_id')
				->Join('county', 'county.id', '=', 'childrens.county')
				->Join('dist_center', 'dist_center.id', '=', 'childrens.dist_center_id')				
				->whereIn('order_track.id',$dataarray)
				->select('order_track.*','childrens.name','county.name AS cname','dist_center.name AS dcname')
				->get();
			$mainarray = array();	
			foreach($childrens as $child)
			{
				$array = array();
				$array['childname'] = $child->name;
				$array['cname'] = $child->cname;
				$array['dcname'] = $child->dcname;
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
		$notification = array(
            'message' => 'Recipient Add succesfully!', 
            'alert-type' => 'success'
        );		
		return view('doner.gift.sendgift', compact('mainarray'))->with($notification);
	}
}
