@extends('layouts.admin.app')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Recipient</h3>
				</div>
				<div class="box-body"> 
				
				<div class="col-md-12">
					
					{!! Form::open(['method' => 'GET', 'route' => ['childrenslist.index']]) !!}
						
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
										<option value="{{ $coun->id }}" @if($coun->id == Request::get('county')) selected @endif>{{ $coun->name }}</option>
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
						<button style="margin-bottom: 10px; display:none;" class="btn btn-primary select_all">Send Gifts</button>
					</div>
					<div class="col-md-12">
						<div class="table-responsive users-table">
							<table class="table table-striped table-sm data-table">
									<thead>
										<tr>
											<th style="text-align:center;"><input type="checkbox" id="master" disabled></th>
											<th>Family Name</th>
											<th>Name</th>
											<th>Age</th>
											<th>Gender</th>
											<th>County</th>
											<th>Actions</th>
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
														<a class="btn btn-sm btn-success btn-block" href="{{ route('childrenslist.show',[$children->id]) }}" data-toggle="tooltip" title="Show">View</a>
													</td>
													
													<td>
														<a class="btn btn-sm btn-info btn-block" href="{{ route('childrenslist.sendgift',[$children->id]) }}" data-toggle="tooltip" title="Edit">Send Gift</a>
														
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
{!! Form::open(['method' => 'POST', 'route' => ['childrenslist.sendgifts'], 'id' => 'sendgiftform']) !!}
{!! Form::hidden('ids','', array('id' => 'ids')) !!}
{!! Form::close() !!}	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		var notchecked = $('.sub_chk:checked').size();
		if(notchecked > 1)
		{
			$('.select_all').show();
		}
		else
		{
			$('.select_all').hide();
		}
		
		$('.sub_chk').on('click', function(e) {
         var nochecked = $('.sub_chk:checked').size();
			if(nochecked > 1)
			{
				$('.select_all').show();
			}
			else
			{
				$('.select_all').hide();
			}
        });

        $('.select_all').on('click', function(e) {
			var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            }); 	
			var join_selected_values = allVals.join(","); 
			$("#ids").val(join_selected_values);
			var check = confirm("Are you Sure? Do you want to send a gift?");  
            if(check == true){  
				if ($('#ids').val() !== null)
				{
					$('#sendgiftform').submit();
				}
			}
        });
	});	
</script>	


@endsection