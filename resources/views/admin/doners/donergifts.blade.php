@extends('layouts.admin.app')
@section('content')
    <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Gifts</h3>
				</div>
				<div class="box-body">
					<div class="card">
					<div class="col-md-12">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <thead>
                                    <tr>
										<tr>
											<th>Recipient Name</th>
											<th>County</th>
											<th>Distribution Center</th>
											<th>Order Date Time</th>
											<th>Actions</th>
										</tr>
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach ($gifts as $gift)
									<tr data-entry-id="{{ $gift->id }}">
										<td>{{ $gift->name }}</td>
										<td>{{ $gift->doner_county }}</td>
										<td>{{ $gift->doner_dist_center }}</td>
										<td>{{ $gift->order_date }}</td>
										<td>
											<a class="btn btn-sm btn-success btn-block" href="{{ route('users.doner.gifts',[$gift->id]) }}" data-toggle="tooltip" title="Show">View</a>
										</td>
									</tr>
									@endforeach
                                </tbody>
                            </table>

                            {{ $gifts->links() }}
                        </div>
                    </div>
					</div>
                </div>
            </div>
        </div>		
@endsection