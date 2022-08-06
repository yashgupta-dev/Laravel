<div id="logofootelsi" class="log-bg">
			    <div class="logosdk">
			    <a href="http://grezns.com"><img src="{{ asset('welcome/img/horrizontallogo2.png') }}" alt="Grezns" style="    filter:none; brightness(0.5);"></a>
			  </div>
            <div class="toppHeader">
               <div class="headertop">
                  <div class="rowdiv">
                    <div class="ulanes">
                        <ul style="padding:0px;">
                            <li><a href="@guest # @else @endif"><i class="fas fa-gift"></i> &nbsp;Offers</a></li>
                            <li><a href="@guest # @else @endif"><i class="fas fa-search"></i> &nbsp;My Reservation</a></li>
                            <li><a href="@guest # @else {{ route('member') }} @endif" style="padding-right:0px;"><i class="fas fa-users"></i> &nbsp;For Member</a></li>
                        </ul>
					</div>
					<div class="usersdname">
                        @guest
                        <a href="{{ route('login') }}">
                            <h5><i class="fas fa-user-circle"></i> &nbsp;Login</h5>
                        </a>
                        @else
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <h5><i class="fas fa-sign-out"></i> &nbsp;{{ __('Logout') }}</h5>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @endif
                    </div>
                  </div>
                  <div class="btn-toggle2">
                     <div class="togglebtn2">
                        <span class="spanline1"></span>
                        <span class="spanline2"></span>
                        <span class="spanline3"></span>
                     </div>
                  </div>
               </div>
             
            </div>
            <div class="scrollbtnss">
               <a><span></span></a>
            </div>
         </div>