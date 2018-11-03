@extends('layouts.admin.app')
@section('content')
<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sent Gift</h3>
				</div>
				<div class="box-body">
					<div class="card">	
					
					<div class="col-md-12">
					{!! Form::open(['method' => 'POST', 'route' => ['ordertrack.store'], 'files' => true, 'class' => 'form-horizontal']) !!}
						@if($children)
						@foreach($children as $child)		
						<div class="form-group row">
							<div class="col-md-12">
								<div class="col-md-12">
									<strong>Recipient Name:</strong> {{ $child->name }}
								</div>
								<div class="col-md-12">
									<strong>Wish List:</strong> {{ $child->wishlist1 }} , {{ $child->wishlist2 }}
								</div>
								
								<div class="col-md-12">
									<strong>Recipient Address:</strong> {{ $child->cname }}  {{ $child->dcname }}
								</div>
							</div>
						</div>
						<input type="hidden" name="ids[]" value="{{ $child->id }}">
						<div id="buildyourform-{{ $child->id }}">
							<div class="col-md-12 form-group">
								<div class="col-md-4">
									<input type="text" name="giftname[{{ $child->id }}][]" class="form-control" placeholder="Gift Detail">
								</div>
								<div class="col-md-2">
									<input type="text" name="size[{{ $child->id }}][]" class="form-control" placeholder="size">
								</div>
								<div class="col-md-4">
									<input type="text" name="note[{{ $child->id }}][]" class="form-control" placeholder="Note">
								</div>
								<div class="col-md-2">
									<a href="#" onclick="theFunction({{ $child->id }});">Add More Gift</a>
								</div>
							</div>
						</div>
						<h2>&nbsp;</h2>
						<hr>
						@endforeach
						<h4>Delivery Location</h4>
						<p class="help-block">Choose a county and distribution center were you will submit your gifts.</p>
						<div class="form-group col-md-12">
							<div class="col-md-6">
								<select name="county" class="form-control" id="countyid">
									<option value="">Select County</option>
									@foreach($County as $count)
										<option value="{{ $count->name }}">{{ $count->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6">
								<select name="doner_dist_center" class="form-control" id="doner_dist_center">
									<option value="">Select Distribution Center</option>
								</select>
							</div>
						</div>
						<div class="form-group col-md-12">
							<div class="col-md-12">
								<textarea name="other_note" class="form-control" placeholder="Note"></textarea>
							</div>
						</div>			
						<div class="form-group">
							<div class="col-md-12">
								{!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
							</div>
						</div>
						@endif	
											
						{!! Form::close() !!}
					</div>
					
					</div>
				</div>
			</div>
		</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ url('public/adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
<script src="{{ url('public/adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">
  $(function () {
    $('.datetime').datepicker({
      viewMode: 'years'
    });
  });
</script>
<script>
function theFunction (ids) 
{
	var lastField = $("#buildyourform-"+ ids +" div:last");
    var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
    var fieldWrapper = $("<div class=\"col-md-12 form-group\" id=\"field" + intId + "\"/>");
    fieldWrapper.data("idx", intId);
    var fields = $('<div class="col-md-4"><input type="text" name="giftname['+ids+'][]" class="form-control" placeholder="Gift Name"></div><div class="col-md-2"><input type="text" name="size['+ids+'][]" class="form-control" placeholder="size"></div><div class="col-md-4"><input type="text" name="note['+ids+'][]" class="form-control" placeholder="Note"></div>');
    var removeButton = $("<div class=\"col-md-2\"><input type=\"button\" class=\"remove\" value=\"-\" /></div>");
    removeButton.click(function() {
		$(this).parent().remove();
    });
    fieldWrapper.append(fields);
    fieldWrapper.append(removeButton);
    $("#buildyourform-"+ids).append(fieldWrapper);
}
</script>
<script>
$('#countyid').on('change', function() {
	var id = this.value;
	$.ajax({ 
            url: "{{ URL::to('selectdistributed') }}",
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: 'ids='+id,
            success: function (data) {
                $("#doner_dist_center").html(data);    
			}
	});		
});
</script>
@endsection


