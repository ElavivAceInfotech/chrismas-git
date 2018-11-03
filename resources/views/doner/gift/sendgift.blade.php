@extends('layouts.admin.app')
@section('content')
<div class="row">
<div class="col-xs-12 col-md-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Gifts View</h3>
				</div>
				<div class="box-body">
					<div class="card">
						@foreach($mainarray as $subarray)	
						<div class="row invoice-info">
							<div class="col-md-4 invoice-col">
							  <address>
								<strong>Recipient Name: </strong> {{ $subarray['childname'] }}<br>
								<strong>Recipient Address: </strong> {{ $subarray['cname'] }} {{ $subarray['dcname'] }}<br>
					
							  </address>
							</div>
							<div class="col-md-4 invoice-col">
							  <address>
								<strong>Doner Name: </strong> {{ Auth::user()->name }}<br>
								<strong>Doner Address: </strong> {{ $subarray['county'] }} {{ $subarray['dist_center'] }}<br>
							  </address>
							</div>
							<div class="col-md-4 invoice-col">
							  <address>
								Barcode
							  </address>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 table-responsive">
								<table class="table table-striped">
								<thead>
								<tr>
								  <th>Gift Name</th>
								  <th>Size</th>
								  <th>Note</th>
								</tr>
								</thead>
								<tbody>
								@foreach($subarray['gifts'] as $gifts)
								<tr>
								  <td>{{ $gifts['gift_name'] }}</td>
								  <td>{{ $gifts['size'] }}</td>
								  <td>{{ $gifts['note'] }}</td>
								</tr>
								@endforeach
								</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							 <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
								Note : {{ $subarray['other_note'] }}
							 </p>
							</div> 
						</div>
	  
						<div class="row no-print">
							<div class="col-md-12">
								<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
									<i class="fa fa-downoad"></i> Generate PDF
								</button>
							</div>
						</div>
						<h6><hr></h6>
						@endforeach
					</div>
					
					@if(Route::currentRouteName() == 'ordertrack.show')
						<a href="{{ route('ordertrack.index') }}" class="btn btn-default">Back to List</a>
					@else
						<a href="{{ route('childrenslist.index') }}" class="btn btn-default">Back to List</a>
					@endif
				</div>
			</div>
		</div>
</div>
@endsection


