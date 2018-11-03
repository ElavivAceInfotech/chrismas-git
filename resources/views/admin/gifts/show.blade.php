@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.gifts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.gifts.fields.title')</th>
                            <td field-key='title'>{{ $gift->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.gifts.fields.pickup')</th>
                            <td field-key='pickup'>{{ $gift->pickup }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.gifts.fields.size')</th>
                            <td field-key='size'>{{ $gift->size }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.gifts.fields.photo')</th>
                            <td field-key='photo'>@if($gift->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $gift->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $gift->photo) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.gifts.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
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
