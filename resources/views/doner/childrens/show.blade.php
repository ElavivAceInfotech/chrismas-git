@extends('layouts.admin.app')
@section('content')
<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Recipient View</h3>
				</div>
				<div class="box-body">
					<div class="card">	
				
						@if ($children->name)
							<strong>Name :- </strong>
							<span class="text-muted">{{ $children->name }}</span>
							<hr style="margin: 8px 0px;">
						@endif
				 
						@if ($children->age)
							<strong>Age :-</strong>
							<span class="text-muted">{{ $children->age }}
							</span>
							<hr style="margin: 8px 0px;">
						@endif
				
						@if ($children->gender)
							<strong>gender :-</strong>
							<span class="text-muted">@if($children->gender == "M") Male @else Female @endif </span>
							<hr style="margin: 8px 0px;">
						@endif
				
						@if ($children->country)
							<strong>Country :-</strong>
							<span class="text-muted"> {{ $children->country }} </span>
							<hr style="margin: 8px 0px;">
						@endif
						
						@if ($children->race)
							<strong>Race :-</strong>
							<span class="text-muted"> {{ $children->race }} </span>
							<hr style="margin: 8px 0px;">
						@endif
						
						@if ($children->wishlist1)
							<strong>Wishlist 1 :-</strong>
							<span class="text-muted"> {{ $children->wishlist1 }} </span>
							<hr style="margin: 8px 0px;">
						@endif
						
						@if ($children->wishlist2)
							<strong>wishlist 2 :-</strong>
							<span class="text-muted"> {{ $children->wishlist2 }} </span>
							<hr style="margin: 8px 0px;">
						@endif
						
						@if ($children->note)
							<strong>Note :-</strong>
							<span class="text-muted"> {{ $children->note }} </span>
							<hr style="margin: 8px 0px;">
						@endif
						
						@if ($children->shirt_size)
							<strong>Shirt Size :-</strong>
							<span class="text-muted"> {{ $children->shirt_size }} </span>
							<hr style="margin: 8px 0px;">
						@endif
						
						@if ($children->pants_size)
							<strong>Pants Size :-</strong>
							<span class="text-muted"> {{ $children->pants_size }} </span>
							<hr style="margin: 8px 0px;">
						@endif
						
						@if ($children->coat_size)
							<strong>Coat Size :-</strong>
							<span class="text-muted"> {{ $children->coat_size }} </span>
							<hr style="margin: 8px 0px;">
						@endif
						
						@if ($children->shoe_size)
							<strong>Shoe Size :-</strong>
							<span class="text-muted"> {{ $children->shoe_size }} </span>
							<hr style="margin: 8px 0px;">
						@endif
						
						@if ($children->other)
							<strong>Other :-</strong>
							<span class="text-muted"> {{ $children->other }} </span>
							<hr style="margin: 8px 0px;">
						@endif
					</div>
					<a href="{{ route('childrenslist.index') }}" class="btn btn-default">Back to List</a>
				</div>
			</div>
		</div>
</div>
@endsection


