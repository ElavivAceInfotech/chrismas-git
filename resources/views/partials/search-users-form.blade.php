<div class="row">
        {!! Form::open(['route' => 'search-users', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'id' => 'search_users']) !!}
            {!! csrf_field() !!}
				<div class="input-group-append col-md-2 pull-right">
                    <a href="#" class="input-group-addon btn btn-warning clear-search" data-toggle="tooltip" title="@lang('backend.common.clear-search')" style="display:none;">
                        <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                        <span class="sr-only">
                            @lang('backend.common.clear-search')
                        </span>
                    </a>
                    <a href="#" class="input-group-addon btn btn-secondary" id="search_trigger" data-toggle="tooltip" data-placement="bottom" title="@lang('backend.common.submit-search')" >
                        <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                        <span class="sr-only">
                            {{  trans('backend.common.submit-search') }}
                        </span>
                    </a>
                </div>
				<div class="col-md-3 pull-right">
                {!! Form::text('user_search_box', NULL, ['id' => 'user_search_box', 'class' => 'form-control', 'placeholder' => trans('backend.common.search-ph'), 'aria-label' => trans('backend.common.search-ph'), 'required' => false]) !!}
                </div>
				
        {!! Form::close() !!}
</div>
