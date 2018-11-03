@extends('layouts.admin.app')
@section('content')
<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Gifts View</h3>
				  &nbsp;&nbsp;&nbsp;&nbsp;<button onclick="myFunction()" class="btn btn-default">Back to List</button>
				</div>
				<div class="box-body">
					<div class="card">	
						<div class="row">
							@foreach($mainarray as $subarray)
							@php $ids = $subarray['id']; @endphp
							<div class="col-md-12 form-group">
								<div class="col-md-3"><label>Recipient Name :-</label></div>
								<div class="col-md-9">{{ $subarray['childname'] }}</div>
							</div>
							<div class="col-md-12 form-group">
								<div class="col-md-3"><label>Address :-</label></div>
								<div class="col-md-9">{{ $subarray['county'] }} {{ $subarray['dist_center'] }}</div>
							</div>
							<div class="col-md-12 form-group">
								@foreach($subarray['gifts'] as $gifts)
									<div class="col-md-4">
									<label>Gift Name :-</label>
									{{ $gifts['gift_name'] }}
									</div>
									<div class="col-md-4">
									<label>Size :-</label>
									{{ $gifts['size'] }}
									</div>
									<div class="col-md-4">
									<label>Note :-</label>
									{{ $gifts['note'] }}
									</div>
								@endforeach
							</div>
							<div class="col-md-12 form-group">
								<div class="col-md-3"><label>Other Notes :-</label></div>
								<div class="col-md-9">{{ $subarray['other_note'] }}</div>
							</div>
							<h5>&nbsp;</h5>
							<hr>
							@endforeach
						</div>
					</div>
					
					<a href="{{ route('users.donergifts',[$ids]) }}" class="btn btn-default">Back to List</a>
				</div>
			</div>
		</div>
</div>
@endsection


