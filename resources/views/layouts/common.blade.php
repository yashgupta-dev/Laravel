@php($access = App\Models\Role::where('id',Auth::user()->role->role_id)->select('permission')->first()
['permission'])
<ul class="nav">
    @if(!empty(json_decode($access)->access) && in_array('User/HomeController',json_decode($access)->access)) 
    <li class="nav-item">
	    <a class="nav-link" href="{{ route('home') }}">
	    	<i class="link-icon" data-feather="box"></i>
	    	<span class="link-title">{{ 'Dashboard' }}</span>
	    </a>
	</li>
    @endif
    @if(!empty(json_decode($access)->access) && in_array('User/AccountController',json_decode($access)->access) && in_array('User/AddressController',json_decode($access)->access)) 
	<li class="nav-item">
		<a class="nav-link" data-toggle="collapse" href="#manger" role="button" aria-expanded="false" aria-controls="emails">
		<i class="link-icon" data-feather="align-center"></i>
		<span class="link-title">{{ __('Manager') }}</span>
		<i class="link-arrow" data-feather="chevron-down"></i>
		</a>
		<div class="collapse" id="manger">
		<ul class="nav sub-menu">
            @if(!empty(json_decode($access)->access) && in_array('User/AccountController',json_decode($access)->access))
			<li class="nav-item"><a class="nav-link" href="{{ route('home.accounts') }}">{{ 'View All Accounts' }}</a></li>
            @endif
            @if(!empty(json_decode($access)->access) && in_array('User/AddressController',json_decode($access)->access))
			<li class="nav-item"><a class="nav-link" href="{{ route('home.address') }}">{{ 'View All Address' }}</a></li>
            @endif
		</ul>
		</div>
    </li>
    @endif
	@if(!empty(Auth::user()->isPartner) &&  count(json_decode(Auth::user()->isPartner['menu_permission'])->menues) > 0)
			
	<li class="nav-item">
		<a class="nav-link" data-toggle="collapse" href="#hotel" role="button" aria-expanded="false" aria-controls="emails">
		    <i class="link-icon" data-feather="package"></i>
		    <span class="link-title">{{ __('Hotel Manager') }}</span>
		        <i class="link-arrow" data-feather="chevron-down"></i>
		</a>
		<div class="collapse" id="hotel">
            <ul class="nav sub-menu">
            @foreach(json_decode(Auth::user()->isPartner['menu_permission'])->menues as $row => $v) 
                @if($v == 'hotel_manger')
                <li class="nav-item">
                    <a href="{{ route('admin.hotel.list') }}" class="nav-link">{{ __('Hotel Management') }}</a>
                </li>
                @endif
                @if($v == 'rooms_manager')
                <li class="nav-item">
                    <a href="{{ route('admin.hotel.room') }}" class="nav-link">{{ __('Room Management') }}</a>
                </li>
                @endif
                @if($v == 'facilities')
                <li class="nav-item">
                    <a href="{{ route('admin.hotel.facilities') }}" class="nav-link">{{ __('Facilities') }}</a>
                </li>
                @endif
                @if($v == 'optional_facilities')
                <li class="nav-item">
                    <a href="{{ route('admin.hotel.optional.facilities') }}" class="nav-link">{{ __('Optional Facilities') }}</a>
                </li>
                @endif
                @if($v == 'booking')
                <li class="nav-item">
                    <a href="{{ route('admin.hotel.booking') }}" class="nav-link">{{ __('Booking Management') }}</a>
                </li>
                @endif
            @endforeach
            </ul>
		</div>
    </li>
	@endif
	@if(in_array('User/TicketController',json_decode($access)->access) && config('settings.ticket_module_status'))
	<li class="nav-item nav-category">{{ __('global.support') }}</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="collapse" href="#help" role="button" aria-expanded="false" aria-controls="emails">
		    <i class="link-icon" data-feather="headphones"></i>
			<span class="link-title">{{ __('global.support') }}</span>
			<i class="link-arrow" data-feather="chevron-down"></i>
		</a>
		<div class="collapse" id="help">
			<ul class="nav sub-menu">
				<li class="nav-item">
					<a href="{{ route('home.support') }}" class="nav-link">{{ __('global.tickets') }}</a>
				</li>
			</ul>
		</div>
	</li>
	@endif
</ul>