@extends('layouts.admin.app')
@section('content')
    <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Doners</h3>
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
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection