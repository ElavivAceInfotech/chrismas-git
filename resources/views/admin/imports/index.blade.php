@extends('layouts.admin.app')
@section('content')
<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Import Recipient</h3>
				</div>
				<div class="box-body">
                    {!! Form::open(['method' => 'POST', 'route' => ['imports.import'], 'files' => true ]) !!}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file" class="col-md-4 control-label">CSV file to import</label>

                                <div class="col-md-6">
                                    <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="header" checked> File contains header row?
                                        </label>
                                    </div>
									<a href="{{ URL::to('public/Christmas-Wish-Lists-Spreadsheet.csv') }}" download>Download Sample CSV</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    {!! Form::submit( "Import Now", ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                            
                            {!! Form::close() !!}
                    </div>
            </div>
        </div>
    </div>
@endsection