<ul class="sidebar-menu" data-widget="tree">
		<li class="{{ Request::is('admin/home') ? 'active' : null }}">
			<a class="" href="{{ url('/admin/home') }}">
				<i class="fa fa-dashboard"></i>
				<span>Dashboard</span>
			</a>
		</li>	
		@if(Auth::user()->isAdmin())
		
		<li>
            <a href="{{ URL::to('admin/doners') }}">
                <i class="fa fa-users"></i>
                <span>Donors</span>
            </a>
        </li>
		
		<li>
            <a href="{{ URL::to('admin/distributors') }}">
                <i class="fa fa-user-secret"></i>
                <span>Distributors</span>
            </a>
        </li>
	
		<li>
            <a href="{{ URL::to('childrens') }}">
                <i class="fa fa-child"></i>
                <span>Recipient</span>
            </a>
        </li>
		
		<li>
            <a href="{{ URL::to('admin/imports') }}">
                <i class="fa fa-database"></i>
                <span>Import Recipient</span>
            </a>
        </li>
	
		@endif
		
		
		@if(Auth::user()->isDonor())
		
		<li>
            <a href="{{ URL::to('childrenslist') }}">
                <i class="fa fa-child"></i>
                <span class="title">Recipient list</span>
            </a>
        </li>
		
		<li>
            <a href="{{ URL::to('ordertrack') }}">
                <i class="fa fa-gift"></i>
                <span class="title">Sent Gifts</span>
            </a>
        </li>
	
		@endif


		@if(Auth::user()->isWarehouse())

			
		@endif

		<li>
            <a href="{{ URL::to('change_password') }}">
                <i class="fa fa-key"></i>
                <span class="title">Change password</span>
            </a>
        </li>

        <li>
            <a href="#logout" onclick="$('#logout').submit();">
                <i class="fa fa-arrow-left"></i>
                <span class="title">Logout</span>
            </a>
        </li>
		
		
</ul>