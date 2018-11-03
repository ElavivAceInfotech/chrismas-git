<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Children;
use App\Models\Family;
use App\Models\County;
use App\Models\Distcenter;
use DB;
use Importer;
use Session;
class ImportsController extends Controller
{
    public function index()
    {
        return view('admin.imports.index');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'csv_file' => 'required|mimes:csv,txt'
        ]);
        
        try{

            if($request->file('csv_file'))
            {
                $filename = $request->file('csv_file')->getClientOriginalName();
                $path_obj = $request->file('csv_file')->move(public_path('csv'), $filename);
    
                $path = $path_obj->getPathname();
                $excel = Importer::make('Csv');
                $path =  $path_obj;
                $excel->load($path_obj->getPathname());
                $data = $excel->getCollection();
                if(!empty($data) && $data->count())
                {
					$i =0;
                    foreach ($data->toArray() as $row)
                    {
						if($i == 0)
						{ 
					
						if(!empty($row))
                        {
							foreach($row as $key => $rowNumber)
							{
								if($rowNumber == "Name"){
									$namePosition = $key;
								}elseif($rowNumber == "Age"){
									$agePosition = $key;
								}elseif($rowNumber == "Race"){
									$racePosition = $key;
								}elseif($rowNumber == "Gender"){
									$genderPosition = $key;
								}elseif($rowNumber == "County"){
									$countyPosition = $key;
								}elseif($rowNumber == "Wish1 Description"){
									$whish1Position = $key;
								}elseif($rowNumber == "Wish2 Description"){
									$wish2Position = $key;
								}elseif($rowNumber == "Notes"){
									$notePosition = $key;
								}elseif($rowNumber == "Family"){
									$familyPosition = $key;
								}elseif($rowNumber == "Shirt/Top Size"){
									$shirtPosition = $key;
								}elseif($rowNumber == "Pants/Jeans Size"){
									$pantsPosition = $key;
								}elseif($rowNumber == "Coat Size"){
									$coatPosition = $key;
								}elseif($rowNumber == "Shoe Size"){
									$shoePosition = $key;
								}
								
								
							}
                        }
						$i++;
						}
						else
						{
								if(isset($namePosition))
								{
									$subdataArray['name'] = $row[$namePosition];
								}
								if(isset($familyPosition))
								{
									$Family = Family::where('name',$row[$familyPosition])->count();
									if($Family  == 0)
									{
										$Family = Family::create(['name' =>$row[$familyPosition]]); 
										$subdataArray['family_id'] = $Family->id;
									}
									else
									{
										$Family = Family::where('name',$row[$familyPosition])->first();
										$subdataArray['family_id'] = $Family->id;
									}
								}
                                if(isset($agePosition))
								{
									$subdataArray['age'] = $row[$agePosition];
								}	
                                if(isset($genderPosition))
								{
									$subdataArray['gender'] = $row[$genderPosition];
                                }
								if(isset($countyPosition))
								{
									$countyname = trim(strtolower($row[$countyPosition])); 
									$countyname = ucfirst($countyname);
									$countynames = trim(strstr($countyname, '(', true));
									$dist_center = strstr($countyname,"(");
									$chkcounty = DB::table('county')
													->Join('dist_center', 'dist_center.county_id', '=', 'county.id')
													->where('county.name',$countynames)
													->where('dist_center.name',$dist_center)
													->select('dist_center.id','dist_center.county_id')
													->first();
									if($chkcounty == null)
									{
										$chkcountytwo = County::where('name',$countynames)->first();
										if($chkcountytwo == null)
										{
											$County = County::create([
												'name'             => $countynames,
											]);
											$subdataArray['county'] = $County->id;
											$Distcenter = Distcenter::create([
												'name'             => $dist_center,
												'county_id'		   => $County->id,
											]);
											$subdataArray['dist_center_id'] = $Distcenter->id;
										}
										else
										{
											$subdataArray['county'] = $chkcountytwo->id;
											$Distcenter = Distcenter::create([
												'name'             => $dist_center,
												'county_id'		   => $chkcountytwo->id,
											]);
											$subdataArray['dist_center_id'] = $Distcenter->id;
										}
									}
									else
									{
										$subdataArray['county'] = $chkcounty->county_id;
										$subdataArray['dist_center_id'] = $chkcounty->id;
											
									}
								}
								if(isset($racePosition))
								{
									$subdataArray['race'] = $row[$racePosition];
								}
                                if(isset($whish1Position))
								{
									$subdataArray['wishlist1'] = $row[$whish1Position];
								}
                                if(isset($wish2Position))
								{
									$subdataArray['wishlist2'] = $row[$wish2Position];
                                }
								if(isset($notePosition))
								{
									$subdataArray['note'] = $row[$notePosition];
								}
								if(isset($shirtPosition))
								{
									$subdataArray['shirt_size'] = $row[$shirtPosition];
								}
								if(isset($pantsPosition))
								{
									$subdataArray['pants_size']  = $row[$pantsPosition];
								}
								if(isset($coatPosition))
								{
									$subdataArray['coat_size']	 = $row[$coatPosition];
								}
								if(isset($shoePosition))
								{
									$subdataArray['shoe_size'] = $row[$shoePosition];			
								}
								$subdataArray['created_at'] = date('Y-m-d H:i:s');
                                $subdataArray['updated_at'] = date('Y-m-d H:i:s');
								
							$dataArray[] = $subdataArray;
						}
						
                    }
					if(!empty($dataArray))
                    {
						DB::table('childrens')->insert($dataArray);
                        $notification = array(
                            'message' => 'Childrens imported succesfully!', 
                            'alert-type' => 'success'
                        );
                    }
                }else{
                    $notification = array(
                        'message' => 'No record imported!', 
                        'alert-type' => 'info'
                    );
                }
            }
        } 
        catch(\Exception $e){
            $notification = array(
                'message' => 'Error: Something went wrong!', 
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        return redirect()->back()->with($notification);
    }
}
