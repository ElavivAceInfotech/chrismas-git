@extends('layouts.admin.app')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Change password</h3>
				</div>
				<div class="box-body">
					@if (Session::has('success'))
						<div class="row">
						<div class="col-xs-12 form-group">
						<div class="alert alert-success">{{ Session::get('success') }}</div>
						</div>
						</div>
					@endif
					@if (Session::has('error'))
						<div class="row">
						<div class="col-xs-12 form-group">
						<div class="alert alert-danger">{{ Session::get('error') }}</div>
						</div>
						</div>
					@endif
					{!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}
					<!-- If no success message in flash session show change password form  -->
							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('current_password', 'Current password', ['class' => 'control-label']) !!}
									{!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => '']) !!}
									<p class="help-block"></p>
									@if($errors->has('current_password'))
										<p class="help-block">
											{{ $errors->first('current_password') }}
										</p>
									@endif
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('new_password', 'New password', ['class' => 'control-label']) !!}
									{!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => '']) !!}
									<p class="help-block"></p>
									@if($errors->has('new_password'))
										<p class="help-block">
											{{ $errors->first('new_password') }}
										</p>
									@endif
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('new_password_confirmation', 'New password confirmation', ['class' => 'control-label']) !!}
									{!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => '']) !!}
									<p class="help-block"></p>
									@if($errors->has('new_password_confirmation'))
										<p class="help-block">
											{{ $errors->first('new_password_confirmation') }}
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
								</div>
							</div>	
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>	
@endsection

