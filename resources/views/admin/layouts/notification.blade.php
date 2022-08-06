@php($access = App\Models\Role::where('id',Auth::guard('admin')->user()->role->role_id)->select('permission')->first()
['permission'])
<!-- partial:partials/_navbar.html -->
            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
					<i data-feather="menu"></i>
				</a>
                <div class="navbar-content">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown nav-notifications">
                            <a class="nav-link dropdown-toggle" href="javascript:;" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i data-feather="bell"></i>
									@if(count(Auth::guard('admin')->user()->unreadNotifications))
									<div class="indicator">
										<div class="circle"></div>
									</div>
									@endif
								</a>

                            <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                                <div class="dropdown-header d-flex align-items-center justify-content-between">
                                    <p id="count" class="mb-0 font-weight-medium" data-count="{{ count(Auth::guard('admin')->user()->unreadNotifications) }}">
                                        @if(!count(Auth::guard('admin')->user()->unreadNotifications)) {{ __('No Notifications') }} @else {{ count(Auth::guard('admin')->user()->unreadNotifications) }} {{ __(' New Notifications') }} @endif
                                    </p>
                                    @if(count(Auth::guard('admin')->user()->unreadNotifications))
                                    <a href="javascript:;" class="text-muted" id="clear-all">{{ __('Clear all') }}</a> @endif
                                </div>
                                <div class="dropdown-body" @if(count(Auth::guard( 'admin')->user()->unreadNotifications) >= 5) style="height:400px;overflow-y:scroll;" @endif> @forelse(Auth::guard('admin')->user()->unreadNotifications as $notification)
                                    <a href="javascript:;" data-id="{{ $notification->id }}" data-url="{{ $notification->data['url'] }}" id="mark-as-read" class="dropdown-item">
                                        <div class="icon">
                                            <i data-feather="{{ $notification->data['icon'] }}"></i>
                                        </div>
                                        <div class="content">
                                            <p>{{ $notification->data['message'] }}</p>
                                            <p class="sub-text text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</p>
                                        </div>
                                    </a>
                                    @empty
                                    <a href="javascript:;" class="dropdown-item">
                                        <div class="icon">
                                            <i data-feather="alert-circle"></i>
                                        </div>
                                        <div class="content">
                                            {{ __('No new notifications') }}
                                        </div>
                                    </a>
                                    @endforelse
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown nav-profile">
                            <a class="nav-link dropdown-toggle" href="javascript:;" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									@if(!in_array(Auth::guard('admin')->user()->profile,['0','1','2','3','4']))
										<img src="{{ asset('storage') }}/profile/{{ explode('/',Auth::guard('admin')->user()->profile)[2] }}" alt="{{ Auth::guard('admin')->user()->name }}" style="object-fit: cover;">
									@else
										<img src="{{ asset('logo') }}/{{ Auth::guard('admin')->user()->profile }}.png" style="object-fit: cover;">
									@endif
								</a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                <div class="dropdown-body">
                                    <ul class="profile-nav p-0">
                                        <li class="nav-item mb-2"><span class=" text-gray font-weight-light">Manage Account</span></li>
                                        @if(!empty(json_decode($access)->access) && in_array('Admin/ProfileController',json_decode($access)->access)) 
                                        <li class="nav-item">
                                            <a href="{{ route('admin.profile') }}" class="nav-link">
													<i data-feather="smile"></i>
													<span>Profile</span>
												</a>
                                        </li>
                                        @endif
                                        <li class="nav-item border-top"></li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        			<i data-feather="log-out"></i>
													<span>{{ __('Sign out')}}</span>
													<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;"> @csrf </form>
												</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
            <!-- partial -->
