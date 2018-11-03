@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.gifts.title')</h3>
    
    {!! Form::model($gift, ['method' => 'PUT', 'route' => ['admin.gifts.update', $gift->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('quickadmin.gifts.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pickup', trans('quickadmin.gifts.fields.pickup').'', ['class' => 'control-label']) !!}
                    {!! Form::text('pickup', old('pickup'), ['class' => 'form-control datetime', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('pickup'))
                        <p class="help-block">
                            {{ $errors->first('pickup') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('size', trans('quickadmin.gifts.fields.size').'', ['class' => 'control-label']) !!}
                    {!! Form::text('size', old('size'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('size'))
                        <p class="help-block">
                            {{ $errors->first('size') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($gift->photo)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$gift->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$gift->photo) }}"></a>
                    @endif
                    {!! Form::label('photo', trans('quickadmin.gifts.fields.photo').'', ['class' => 'control-label']) !!}
                    {!! Form::file('photo', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('photo_max_size', 2) !!}
                    {!! Form::hidden('photo_max_width', 4096) !!}
                    {!! Form::hidden('photo_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('photo'))
                        <p class="help-block">
                            {{ $errors->first('photo') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop