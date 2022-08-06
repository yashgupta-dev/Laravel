@php($access = App\Models\Role::where('id',Auth::guard('admin')->user()->role->role_id)->select('permission')->first()
['permission'])
<ul class="nav">
    @if(!empty(json_decode($access)->access) && in_array('Admin/HomeController',json_decode($access)->access)) 
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">{{ __('global.dashboard') }}</span>
        </a>
    </li>
    @endif
    @if(!empty(json_decode($access)->access) && in_array('Admin/UsersController',json_decode($access)->access)) 
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#customers" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="users"></i>
            <span class="link-title">{{ __('global.customers') }}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="customers">
            <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="{{ route('admin.client') }}" class="nav-link">{{ __('global.customers') }}</a>
                </li>
            </ul>
        </div>
    </li>
    @endif
    @if(!empty(json_decode($access)->access) && in_array('Admin/CategoryController',json_decode($access)->access)) 
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#category" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="align-center"></i>
            <span class="link-title">{{ __('global.category') }}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="category">
            <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="{{ route('admin.category') }}" class="nav-link">{{ __('global.category_list') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.category.add') }}" class="nav-link">{{ __('global.category_add') }}</a>
                </li>
            </ul>
        </div>
    </li>
    @endif
    
    @if(!empty(json_decode($access)->access) && in_array('Admin/Hotel/HotelController',json_decode($access)->access) && in_array('Admin/Hotel/RoomController',json_decode($access)->access) && in_array('Admin/Hotel/FacilitiesController',json_decode($access)->access) && in_array('Admin/Hotel/OptionalFacilitiesController',json_decode($access)->access) && in_array('Admin/Hotel/CustomerReviewsController',json_decode($access)->access)) 
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#hotel" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="package"></i>
            <span class="link-title">{{ __('Hotel Manager') }}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="hotel">
            <ul class="nav sub-menu">
            @if(!empty(json_decode($access)->access) && in_array('Admin/Hotel/HotelController',json_decode($access)->access)) 
                <li class="nav-item">
                    <a href="{{ route('admin.hotel.list') }}" class="nav-link">{{ __('Hotel Management') }}</a>
                </li>
                @endif
                @if(!empty(json_decode($access)->access) && in_array('Admin/Hotel/RoomController',json_decode($access)->access)) 
                <li class="nav-item">
                    <a href="{{ route('admin.hotel.room') }}" class="nav-link">{{ __('Manage Rooms') }}</a>
                </li>
                @endif
                @if(!empty(json_decode($access)->access) && in_array('Admin/Hotel/FacilitiesController',json_decode($access)->access)) 
                <li class="nav-item">
                    <a href="{{ route('admin.hotel.facilities') }}" class="nav-link">{{ __('Manage Facilities') }}</a>
                </li>
                @endif
                @if(!empty(json_decode($access)->access) && in_array('Admin/Hotel/OptionalFacilitiesController',json_decode($access)->access)) 
                <li class="nav-item">
                    <a href="{{ route('admin.hotel.optional.facilities') }}" class="nav-link">{{ __('Manage Optional Facilities') }}</a>
                </li>
                @endif
                @if(!empty(json_decode($access)->access) && in_array('Admin/Hotel/CustomerReviewsController',json_decode($access)->access)) 
                <li class="nav-item">
                    <a href="{{ route('admin.hotel.customer.reviews') }}" class="nav-link">{{ __('Customer Reviews') }}</a>
                </li>
                @endif
                @if(!empty(json_decode($access)->access) && in_array('Admin/Hotel/CustomerReviewsController',json_decode($access)->access)) 
                <li class="nav-item">
                    <a href="{{ route('admin.hotel.booking') }}" class="nav-link">{{ __('All Booking') }}</a>
                </li>
                @endif
            </ul>
        </div>
    </li>
    @endif
    @if(!empty(json_decode($access)->access) && in_array('Admin/SettingController',json_decode($access)->access)) 
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#enviorment" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="disc"></i>
            <span class="link-title">{{ __('global.extension') }}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="enviorment">
            <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="{{ route('admin.web.setting.configration') }}" class="nav-link">{{ __('global.extension') }}</a>
                </li>
            </ul>
        </div>
    </li>
    @endif

    @if(!empty(json_decode($access)->access) && config('settings.ticket_module_status') && in_array('Admin/TicketController',json_decode($access)->access))
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
                    <a href="{{ route('admin.ticket') }}" class="nav-link">{{ __('global.tickets') }}</a>
                </li>
            </ul>
        </div>
    </li>
    @endif
    @if(!empty(json_decode($access)->access) && in_array('Admin/Chat/ChatBoatController',json_decode($access)->access))
    <li class="nav-item nav-category">{{ __('Chat System') }}</li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#chatboat" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="play"></i>
            <span class="link-title">{{ __('Chat System') }}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="chatboat">
            <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="{{ route('admin.chat') }}" class="nav-link">{{ __('Chat') }}</a>
                </li>
            </ul>
        </div>
    </li>
    @endif

    @if(!empty(json_decode($access)->access) && in_array('Admin/SettingController',json_decode($access)->access))
    <li class="nav-item nav-category">{{ __('global.setting_env') }}</li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#setting" role="button" aria-expanded="false" aria-controls="uiComponents">
            <i class="link-icon" data-feather="settings"></i>
            <span class="link-title">{{ __('global.setting') }}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="setting">
            <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="{{ route('admin.web.users-list') }}" class="nav-link">{{ __('global.text_user') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.web.setting.permission') }}" class="nav-link">{{ __('global.user_groups') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.web.setting') }}" class="nav-link">{{ __('global.enviorments') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.web.env') }}" class="nav-link">{{ __('global.site') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.web.site') }}" class="nav-link">{{ __('global.setting') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.web.routes') }}" class="nav-link">{{ __('global.routes') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.web.error.logs') }}" class="nav-link">{{ __('global.logs') }}</a>
                </li>
            </ul>
        </div>
    </li>
    @endif
</ul>