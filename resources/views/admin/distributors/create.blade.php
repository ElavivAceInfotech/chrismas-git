@extends('layouts.admin.app')
@section('content')
    <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Distributor Create</h3>
				</div>
				<div class="box-body">
					<div class="card">
						{!! Form::open(array('route' => 'distributors.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation','files' => true)) !!}
						{!! csrf_field() !!}
				
				        <div class="box-body">		  
                
							<div class="form-group">
								{!! Form::label('name', 'Name', array('class' => 'control-label')); !!}
								{!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control')) !!}
								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif 
							</div> 
							
							<div class="form-group">
								{!! Form::label('email', 'Email', array('class' => 'control-label')); !!}
								{!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control')) !!}
								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
							
							<div class="form-group">
							  {!! Form::label('password', trans('backend.forms.create_user_label_password'), array('class' => 'control-label')); !!}
							  {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('backend.forms.create_user_ph_password'))) !!}
							  @if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
							</div>
				
							<div class="form-group">
							  {!! Form::label('password_confirmation', trans('backend.forms.create_user_label_pw_confirmation'), array('class' => 'control-label')); !!}
							  {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('backend.forms.create_user_ph_pw_confirmation'))) !!}
							  @if ($errors->has('password_confirmation'))
									<span class="help-block">
										<strong>{{ $errors->first('password_confirmation') }}</strong>
									</span>
								@endif
							</div>
								
							<div class="form-group">
								{!! Form::button(trans('backend.common.save'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}		
							</div>
						</div>

						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>	
@endsection

