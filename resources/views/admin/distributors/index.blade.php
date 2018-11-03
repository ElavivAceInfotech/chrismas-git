@extends('layouts.admin.app')
@section('content')
    <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Distributors</h3>
				</div>
				<div class="box-body">
				
					<div class="card">
					<div class="col-md-6">
						<button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ route('distributors.mass_destroy') }}">Delete</button>
					</div>
					<div class="col-md-6 text-right">
						<a href="{{ route('distributors.create') }}" class="btn btn-success">Add new</a> 
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
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach($distributors as $distributor)
                                        <tr>
											<td style="text-align:center;"><input type="checkbox" class="sub_chk" data-id="{{$distributor->id}}"></td>
                                            <td>{{ $distributor->name }}</td>
                                            <td>{{ $distributor->email }}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{ $distributor->created_at }}</td>
                                            <td>
												{!! Form::open(array('style' => 'display: inline-block;' ,'method' => 'DELETE', 'class'=>'btn-block' ,'onsubmit' => "return confirm('Are you Sure?');",'route' => ['distributors.destroy', $distributor->id])) !!}
													{!! Form::submit('Delete', array('class'=>'btn btn-sm btn-danger btn-block')) !!}
												{!! Form::close() !!}
											</td>
											<td>
												<a class="btn btn-sm btn-success btn-block" href="{{ route('distributors.show',[$distributor->id]) }}" data-toggle="tooltip" title="Show">View</a>
											</td>
											<td>
												<a class="btn btn-sm btn-info btn-block" href="{{ route('distributors.edit',[$distributor->id]) }}" data-toggle="tooltip" title="Edit">Edit</a>
											</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $distributors->links() }}
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
                        url: "{{ URL::to('distributors_mass_destroy') }}",
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