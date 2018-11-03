@extends('layouts.admin.app')
@section('content')
    <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Donor</h3>
				</div>
				<div class="box-body">
					<div class="card">	
				
						@if ($user->name)
							<strong>Name :- </strong>
							<span class="text-muted">{{ $user->name }}</span>
							<hr style="margin: 8px 0px;">
						@endif
				 
						@if ($user->email)
							<strong>Email :-</strong>
							<span class="text-muted" data-toggle="tooltip" data-placement="top" title="@lang('backend.uers.email-user', ['user' => $user->email])">
								{{ HTML::mailto($user->email, $user->email) }}
							</span>
							<hr style="margin: 8px 0px;">
						@endif
				
						@if ($user->phone)
							<strong>Phone :-</strong>
							<span class="text-muted"> {{ $user->phone }} </span>
							<hr style="margin: 8px 0px;">
						@endif
				
						@if ($user->address)
							<strong>Address :-</strong>
							<span class="text-muted"> {{ $user->address }} </span>
							<hr style="margin: 8px 0px;">
						@endif
						
						@if ($user->city)
							<strong>City :-</strong>
							<span class="text-muted"> {{ $user->city }} </span>
							<hr style="margin: 8px 0px;">
						@endif
						
						@if ($user->county)
							<strong>County :-</strong>
							<span class="text-muted"> {{ $county->name }} </span>
							<hr style="margin: 8px 0px;">
						@endif
					</div>
					<a href="{{ route('doners.index') }}" class="btn btn-default">Back to List</a>
				</div>
			</div>
		</div>
	</div>
@endsection