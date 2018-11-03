@extends('layouts.admin.app')
@section('content')
    <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Donor List</h3>
				</div>
				<div class="box-body">
					<div class="card">
					<div class="col-md-6">
						<button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ route('users.mass_destroy') }}">Delete</button>
					</div>
					<div class="col-md-6 text-right">
						<a href="{{ route('doners.create') }}" class="btn btn-success">Add new</a> 
					</div>
					<div class="col-md-12">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead>
                                    <tr>
										<th style="text-align:center;"><input type="checkbox" id="master"></th>
                                        <th>Name</th> 
                                        <th>Email</th>
										<th>Created</th>
                                        <th>Actions</th>
                                        <th class="no-search no-sort"></th>
                                        <th class="no-search no-sort"></th>
										<th class="no-search no-sort"></th>
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach($doners as $doner)
                                        <tr data-entry-id="{{ $doner->id }}">
											<td style="text-align:center;"><input type="checkbox" class="sub_chk" data-id="{{$doner->id}}"></td>
                                            <td>{{$doner->name}}</td>
                                            <td>{{ $doner->email }}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$doner->created_at}}</td>
                                            <td>
												{!! Form::open(array('style' => 'display: inline-block;' ,'method' => 'DELETE', 'class'=>'btn-block' ,'onsubmit' => "return confirm('Are you Sure?');",'route' => ['doners.destroy', $doner->id])) !!}
													{!! Form::submit('Delete', array('class'=>'btn btn-sm btn-danger btn-block')) !!}
												{!! Form::close() !!}											</td>
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('admin/doners/' . $doner->id) }}" data-toggle="tooltip" title="Show">
                                                   View
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('admin/doners/' . $doner->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                    Edit
                                                </a>
                                            </td>
											<td>
                                                <a class="btn btn-sm btn-primary btn-block" href="{{ URL::to('donergifts/' . $doner->id) }}" data-toggle="tooltip" title="Edit">
                                                    Gifts
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $doners->links() }}
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
                        url: "{{ URL::to('doners_mass_destroy') }}",
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