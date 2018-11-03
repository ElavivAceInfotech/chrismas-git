@extends('layouts.admin.app')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Sent Gifts</h3>
				</div>
				<div class="box-body"> 
					<div class="card">
					<div class="col-md-12">
						<div class="table-responsive users-table">
							<table class="table table-striped table-sm data-table">
									<thead>
										<tr>
											<th>Recipient Name</th>
											<th>County</th>
											<th>Distribution Center</th>
											<th>Order Date Time</th>
											<th>Actions</th>
											<th class="no-search no-sort"></th>
										</tr>
									</thead>
									
									<tbody>
											@foreach ($childrens as $children)
												<tr data-entry-id="{{ $children->id }}">
													<td>{{ $children->name }}</td>
													<td>{{ $children->doner_county }}</td>
													<td>{{ $children->doner_dist_center }}</td>
													<td>{{ $children->order_date }}</td>
													<td>
														<a class="btn btn-sm btn-success btn-block" href="{{ route('ordertrack.show',[$children->id]) }}" data-toggle="tooltip" title="Show">View</a>
													</td>
													<td>
														<a class="btn btn-sm btn-info btn-block" href="#" data-toggle="tooltip" title="Edit">PDF</a>
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
@endsection