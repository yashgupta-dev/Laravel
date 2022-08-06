@section('pusher')
<script src="{{asset('pusher/pusher.min.js')}}"></script>
<script type="text/javascript">
      var notificationsWrapper   = $('.nav-notifications');
      var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
      var notificationsCountElem = $('#count');
      var notificationsCount     = parseInt(notificationsCountElem.data('count'));
      var notifications          = notificationsWrapper.find('div.dropdown-body');

      if (notificationsCount > 5) {
        notifications.css('height','400px');
        notifications.css('overflow-y','scroll');
      }

      // Enable pusher logging - don't include this in production
      // Pusher.logToConsole = true;

      var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
		    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
      });

      // var userChannel = pusher.subscribe('user-broadcast');
      @if(!Auth::guard('admin')->user())
      // Subscribe to the channel we specified in our Laravel Event
        var singleUserChannel = pusher.subscribe('user-{{Auth::user()->id}}');
        // single user event;
        singleUserChannel.bind('App\\Events\\Specificuser', function(data) {
          var existingNotifications = notifications.html();
          var newNotificationHtml = `
            <a href="javascript:;" class="dropdown-item">
              <div class="icon" style="padding: 15px;">
                <i class="fas fa-bullseye text-info"></i>
              </div>
              <div class="content">
                <p>`+data.data.subject+`</p>
                <p class="sub-text text-muted">`+ data.data.msg +`</p>
              </div>
            </a>
          `;
          notifications.html(newNotificationHtml + existingNotifications);
          notificationsToggle.append('<div class="indicator"><div class="circle"></div></div>');
          notificationsCount += 1;
          notificationsCountElem.attr('data-count', notificationsCount);
          notificationsWrapper.find('#count').text(notificationsCount + ' Notifications');
          if (notificationsCount >= 5) {
            notifications.css('height','400px');
            notifications.css('overflow-y','scroll');
          }
          notificationsWrapper.show();
        });
      @endif
      @if(Auth::guard('admin')->user())
      
      // Subscribe to the channel we specified in our Laravel Event
        var chatChannel = pusher.subscribe('admin-{{Auth::guard('admin')->user()->id}}');
        
        // single user event;
        chatChannel.bind('App\\Events\\ChatUpdate', function(data) {
          var existingNotifications = notifications.html();
          var newNotificationHtml = `
            <a href="javascript:;" class="dropdown-item">
              <div class="icon" style="padding: 15px;">
                <i class="fas fa-bullseye text-info"></i>
              </div>
              <div class="content">
                <p>`+data.data.subject+`</p>
                <p class="sub-text text-muted">`+ data.data.msg +`</p>
              </div>
            </a>
          `;
          notifications.html(newNotificationHtml + existingNotifications);
          notificationsToggle.append('<div class="indicator"><div class="circle"></div></div>');
          notificationsCount += 1;
          notificationsCountElem.attr('data-count', notificationsCount);
          notificationsWrapper.find('#count').text(notificationsCount + ' Notifications');
          if (notificationsCount >= 5) {
            notifications.css('height','400px');
            notifications.css('overflow-y','scroll');
          }
          notificationsWrapper.show();
        });
      @endif
      // Bind a function to a Event (the full Laravel class)
      @if(Auth::guard('admin')->user())
      // Subscribe to the channel we specified in our Laravel Event
        var adminChannel = pusher.subscribe('admin-broadcast');
        // admin only event;
        adminChannel.bind('App\\Events\\Admin', function(data) {
          var existingNotifications = notifications.html();
          var newNotificationHtml = `
            <a href="javascript:;" class="dropdown-item">
              <div class="icon" style="padding: 15px;">
                <i class="fas fa-bullseye text-info"></i>
              </div>
              <div class="content">
                <p>`+data.data.subject+`</p>
                <p class="sub-text text-muted">`+ data.data.msg +`</p>
              </div>
            </a>
          `;
          notifications.html(newNotificationHtml + existingNotifications);
          notificationsToggle.append('<div class="indicator"><div class="circle"></div></div>');
          notificationsCount += 1;
          notificationsCountElem.attr('data-count', notificationsCount);
          notificationsWrapper.find('#count').text(notificationsCount + ' Notifications');
          if (notificationsCount >= 5) {
            notifications.css('height','400px');
            notifications.css('overflow-y','scroll');
          }
          notificationsWrapper.show();
        });
      @endif
      // dashboard event fire;
      var adminChannel = pusher.subscribe('fire');
      // admin only event;
      adminChannel.bind('App\\Events\\Dashboard', function() {
        callback();
      });
      // all user event;
      // userChannel.bind('App\\Events\\User', function(data) {
      //   var existingNotifications = notifications.html();
      //   var newNotificationHtml = `
      //     <a href="javascript:;" class="dropdown-item">
      //       <div class="icon" style="padding: 15px;">
      //         <i class="fas fa-bullseye text-info"></i>
			// 			</div>
      //       <div class="content">
      //         <p>`+data.data.subject+`</p>
      //         <p class="sub-text text-muted">`+ data.data.msg +`</p>
      //       </div>
      //     </a>
      //   `;
      //   notifications.append(newNotificationHtml + existingNotifications);
      //   notificationsToggle.append('<div class="indicator"><div class="circle"></div></div>');
      //   notificationsCount += 1;
      //   notificationsCountElem.attr('data-count', notificationsCount);
      //   notificationsWrapper.find('#count').text(notificationsCount + ' Notifications');
      //   notificationsWrapper.show();
      // });

    </script>
@show