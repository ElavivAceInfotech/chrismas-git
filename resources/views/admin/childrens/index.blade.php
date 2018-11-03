@extends('layouts.admin.app')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Recipient</h3>
				</div>
				<div class="box-body"> 
				<div class="col-md-12 text-right">	
					<a href="{{ route('childrens.create') }}" class="btn btn-success">Add new</a>
					<hr>
				</div>	
				
				<div class="col-md-12">
					
					{!! Form::open(['method' => 'GET', 'route' => ['childrens.index']]) !!}
						
						<div class="row">
							<div class="col-md-3 form-group">
								<input type="text" name="name" value="{{ Request::get('name') }}" class="form-control" placeholder="Recipient Name">
							</div>
							
							<div class="col-md-2 form-group">
								<select name="age" class="form-control">
									<option value="">Age</option>
									@for($i=1; $i<=20; $i++)
										<option value="{{ $i }}" @if($i == Request::get('age')) selected @endif>{{ $i }}</option>
									@endfor
								</select>
							</div>
							
							<div class="col-md-2 form-group">
								<select name="gender" class="form-control">
									<option value="">Gender</option>
									<option value="M" @if("M" == Request::get('gender')) selected @endif>Male</option>
									<option value="F" @if("F" == Request::get('gender')) selected @endif>Female</option>
								</select>
							</div>
							
							<div class="col-md-3 form-group">
								<select name="county" class="form-control">
									<option value="">County</option>
									@foreach($countys as $coun)
										<option value="{{ $coun->id }}">{{ $coun->name }}</option>
									@endforeach
								</select>
							</div>
							
							<div class="col-md-2 form-group">
								{!! Form::submit('Search', ['class' => 'btn btn-success btn-block']) !!}
							</div>
							
							
						</div>
					{!! Form::close() !!}
				<hr>
				</div>
					
					<div class="card">
					<div class="col-md-12">
					    <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ route('childrens.perma_del') }}">Delete</button>
					</div>
					<div class="col-md-12">
						<div class="table-responsive users-table">
							<table class="table table-striped table-sm data-table">
									<thead>
										<tr>
											<th style="text-align:center;"><input type="checkbox" id="master"></th>
											<th>Family Name</th>
											<th>Name</th>
											<th>Age</th>
											<th>Gender</th>
											<th>County</th>
											<th>Actions</th>
											<th class="no-search no-sort"></th>
											<th class="no-search no-sort"></th>
										</tr>
									</thead>
									
									<tbody>
											@foreach ($childrens as $children)
												<tr data-entry-id="{{ $children->id }}">
													<td style="text-align:center;"><input type="checkbox" class="sub_chk" data-id="{{$children->id}}"></td>
													<td>{{ $children->fname }}</td>
													<td>{{ $children->name }}</td>
													<td>{{ $children->age }}</td>
													<td>
													@if($children->gender == "M")
													Male
													@else
													Female
													@endif
													</td>
													<td>{{ $children->cname }}</td>
													<td>
														<a class="btn btn-sm btn-success btn-block" href="{{ route('childrens.show',[$children->id]) }}" data-toggle="tooltip" title="Show">View</a>
													</td>
													
													<td>
														<a class="btn btn-sm btn-info btn-block" href="{{ route('childrens.edit',[$children->id]) }}" data-toggle="tooltip" title="Edit">Edit</a>
														
													</td>
													<td>
													{!! Form::open(array('style' => 'display: inline-block;' ,'method' => 'DELETE', 'class'=>'btn-block' ,'onsubmit' => "return confirm('Are you Sure?');",'route' => ['childrens.destroy', $children->id])) !!}
															{!! Form::submit('Delete', array('class'=>'btn btn-sm btn-danger btn-block')) !!}
													{!! Form::close() !!}
													</td>
													
												</tr>
											@endforeach
									</tbody>
							</table>
							{{ $childrens->links() }}
						</div>
					</div>	
					</div>
				</div>
			</div>
		</div>		
	</div>	
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });


        $('.delete_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  


                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  


                    var join_selected_values = allVals.join(","); 


                    $.ajax({
                        url: "{{ URL::to('childrens_perma_del') }}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
									location.reload();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });
	});	
</script>
		
@endsection