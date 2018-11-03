@extends('layouts.admin.app')
@section('content')
    <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">distributors Edit</h3>
				</div>
				<div class="box-body">
					<div class="card">
						{!! Form::open(array('route' => ['distributors.update', $distributors->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation','files' => true)) !!}
							{!! csrf_field() !!}
								
								<div class="form-group">
								{!! Form::label('name', 'Name', array('class' => 'control-label')); !!}
								{!! Form::text('name', $distributors->name, array('id' => 'name', 'class' => 'form-control')) !!}
								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif 
								</div> 
								
								<div class="form-group">
								{!! Form::label('email', 'Email', array('class' => 'control-label')); !!}
								{!! Form::text('email', $distributors->email, array('id' => 'email', 'class' => 'form-control')) !!}
								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif 
								</div> 
					
							<div class="form-group">
								{!! Form::submit('Update', array('class' => 'btn btn-success')) !!}
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection