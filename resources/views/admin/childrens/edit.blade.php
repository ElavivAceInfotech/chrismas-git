@extends('layouts.admin.app')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Recipient Edit</h3>
				</div>
				<div class="box-body">
					{!! Form::model($children, ['method' => 'PUT', 'route' => ['childrens.update', $children->id]]) !!}

							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
									{!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
									<p class="help-block"></p>
									@if($errors->has('name'))
										<p class="help-block">
											{{ $errors->first('name') }}
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('age', 'Age', ['class' => 'control-label']) !!}
									{!! Form::number('age', old('age'), ['class' => 'form-control', 'placeholder' => '']) !!}
									<p class="help-block"></p>
									@if($errors->has('age'))
										<p class="help-block">
											{{ $errors->first('age') }}
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('gender', 'Gender', ['class' => 'control-label']) !!}
									<p class="help-block"></p>
									@if($errors->has('gender'))
										<p class="help-block">
											{{ $errors->first('gender') }}
										</p>
									@endif
									<div>
										<label>
											{!! Form::radio('gender', 'M', false, []) !!}
											Male
										</label>
									</div>
									<div>
										<label>
											{!! Form::radio('gender', 'F', false, []) !!}
											Female
										</label>
									</div>
									
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('county', 'County', ['class' => 'control-label']) !!}
									{!! Form::text('county', old('county'), ['class' => 'form-control', 'placeholder' => '']) !!}
									<p class="help-block"></p>
									@if($errors->has('county'))
										<p class="help-block">
											{{ $errors->first('county') }}
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('race','Race', ['class' => 'control-label']) !!}
									{!! Form::text('race', old('race'), ['class' => 'form-control', 'placeholder' => '']) !!}
									<p class="help-block"></p>
									@if($errors->has('race'))
										<p class="help-block">
											{{ $errors->first('race') }}
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('wishlist1', 'Wishlist 1*', ['class' => 'control-label']) !!}
									{!! Form::textarea('wishlist1', old('wishlist1'), ['class' => 'form-control ', 'placeholder' => '', 'required' => '']) !!}
									<p class="help-block"></p>
									@if($errors->has('wishlist1'))
										<p class="help-block">
											{{ $errors->first('wishlist1') }}
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('wishlist2', 'Wishlist 2', ['class' => 'control-label']) !!}
									{!! Form::textarea('wishlist2', old('wishlist2'), ['class' => 'form-control ', 'placeholder' => '']) !!}
									<p class="help-block"></p>
									@if($errors->has('wishlist2'))
										<p class="help-block">
											{{ $errors->first('wishlist2') }}
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::label('note','Note', ['class' => 'control-label']) !!}
									{!! Form::textarea('note', old('note'), ['class' => 'form-control ', 'placeholder' => '']) !!}
									<p class="help-block"></p>
									@if($errors->has('note'))
										<p class="help-block">
											{{ $errors->first('note') }}
										</p>
									@endif
								</div>
							</div>
							
							<div class="row">
							<div class="col-xs-12 form-group">
								{!! Form::label('shirt_size', 'Shirt Size', ['class' => 'control-label']) !!}
								{!! Form::text('shirt_size', old('shirt_size'), ['class' => 'form-control ', 'placeholder' => '']) !!}
								<p class="help-block"></p>
								@if($errors->has('shirt_size'))
									<p class="help-block">
										{{ $errors->first('shirt_size') }}
									</p>
								@endif
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12 form-group">
								{!! Form::label('pants_size', 'Pants Size', ['class' => 'control-label']) !!}
								{!! Form::text('pants_size', old('pants_size'), ['class' => 'form-control ', 'placeholder' => '']) !!}
								<p class="help-block"></p>
								@if($errors->has('pants_size'))
									<p class="help-block">
										{{ $errors->first('pants_size') }}
									</p>
								@endif
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12 form-group">
								{!! Form::label('coat_size', 'Coat Size', ['class' => 'control-label']) !!}
								{!! Form::text('coat_size', old('coat_size'), ['class' => 'form-control ', 'placeholder' => '']) !!}
								<p class="help-block"></p>
								@if($errors->has('coat_size'))
									<p class="help-block">
										{{ $errors->first('coat_size') }}
									</p>
								@endif
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12 form-group">
								{!! Form::label('shoe_size', 'Shoe Size', ['class' => 'control-label']) !!}
								{!! Form::text('shoe_size', old('shoe_size'), ['class' => 'form-control ', 'placeholder' => '']) !!}
								<p class="help-block"></p>
								@if($errors->has('shoe_size'))
									<p class="help-block">
										{{ $errors->first('shoe_size') }}
									</p>
								@endif
							</div>
						</div>
						
						<div class="row">
							<div class="col-xs-12 form-group">
								{!! Form::label('other', 'Other', ['class' => 'control-label']) !!}
								{!! Form::text('other', old('other'), ['class' => 'form-control ', 'placeholder' => '']) !!}
								<p class="help-block"></p>
								@if($errors->has('other'))
									<p class="help-block">
										{{ $errors->first('other') }}
									</p>
								@endif
							</div>
						</div>
							
							<div class="row">
								<div class="col-xs-12 form-group">
									{!! Form::submit('Update', ['class' => 'btn btn-danger']) !!}
									{!! Form::close() !!}
								</div>
							</div>
							
				</div>
			</div>
		</div>
	</div>			
@endsection

