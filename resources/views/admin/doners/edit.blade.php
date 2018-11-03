@extends('layouts.admin.app')
@section('content')
    <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Donor Edit</h3>
				</div>
				<div class="box-body">
					<div class="card">
						{!! Form::open(array('route' => ['doners.update', $doners->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation','files' => true)) !!}
							{!! csrf_field() !!}
								
								<div class="form-group">
								{!! Form::label('name', 'Name', array('class' => 'control-label')); !!}
								{!! Form::text('name', $doners->name, array('id' => 'name', 'class' => 'form-control')) !!}
								@if ($errors->has('name'))
									<span class="help-block">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif 
							</div> 
							
							<div class="form-group">
								{!! Form::label('email', 'Email', array('class' => 'control-label')); !!}
								{!! Form::text('email', $doners->email, array('id' => 'email', 'class' => 'form-control')) !!}
								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
							
							<div class="form-group">
								{!! Form::label('phone', 'Phone', array('class' => 'control-label')); !!}
								{!! Form::text('phone', $doners->phone, array('id' => 'phone', 'class' => 'form-control')) !!}
								@if ($errors->has('phone'))
									<span class="help-block">
										<strong>{{ $errors->first('phone') }}</strong> 
									</span>
								@endif
							</div>
							
							<div class="form-group">
								{!! Form::label('address', 'Address', array('class' => 'control-label')); !!}
								{!! Form::text('address', $doners->address, array('id' => 'address', 'class' => 'form-control')) !!}
								@if ($errors->has('address'))
									<span class="help-block">
										<strong>{{ $errors->first('address') }}</strong> 
									</span>
								@endif
							</div>
							
							<div class="form-group">
								{!! Form::label('city', 'City', array('class' => 'control-label')); !!}
								{!! Form::text('city', $doners->city, array('id' => 'city', 'class' => 'form-control')) !!}
								@if ($errors->has('city'))
									<span class="help-block">
										<strong>{{ $errors->first('city') }}</strong> 
									</span>
								@endif
							</div>
							
							<div class="form-group">
								{!! Form::label('county', 'County', array('class' => 'control-label')); !!}
								<select name="county" class="form-control">
									<option value="">Select County</option>
									@foreach($county as $counts)
									<option value="{{ $counts->id }}" {{ $counts->id == $doners->county ? 'selected="selected"' : '' }}>{{ $counts->name }}</option>
									@endforeach
								</select>
								@if ($errors->has('county'))
									<span class="help-block">
										<strong>{{ $errors->first('county') }}</strong> 
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