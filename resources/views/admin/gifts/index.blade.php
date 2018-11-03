@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.gifts.title')</h3>
    @can('gift_create')
    <p>
        <a href="{{ route('admin.gifts.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($gifts) > 0 ? 'datatable' : '' }} @can('gift_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('gift_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.gifts.fields.title')</th>
                        <th>@lang('quickadmin.gifts.fields.pickup')</th>
                        <th>@lang('quickadmin.gifts.fields.size')</th>
                        <th>@lang('quickadmin.gifts.fields.photo')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($gifts) > 0)
                        @foreach ($gifts as $gift)
                            <tr data-entry-id="{{ $gift->id }}">
                                @can('gift_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $gift->title }}</td>
                                <td field-key='pickup'>{{ $gift->pickup }}</td>
                                <td field-key='size'>{{ $gift->size }}</td>
                                <td field-key='photo'>@if($gift->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $gift->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $gift->photo) }}"/></a>@endif</td>
                                                                <td>
                                    @can('gift_view')
                                    <a href="{{ route('admin.gifts.show',[$gift->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('gift_edit')
                                    <a href="{{ route('admin.gifts.edit',[$gift->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('gift_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.gifts.destroy', $gift->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('gift_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.gifts.mass_destroy') }}';
        @endcan

    </script>
@endsection