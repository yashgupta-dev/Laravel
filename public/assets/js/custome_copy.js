    /*===================================*
                                                                                                                                                                                                                                                                                                                                                                                        /* toaster setting===================*/

    toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        /*===================================*/
    $(window).on('load', function() {
        setTimeout(function() {
            $(".preloader").delay(700).fadeOut(700).css('display', 'none');
        }, 100);
    });


    $(function(){
        $(".preloader1").delay(700).fadeOut(700).css('display', 'none');
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
        }
    });

    $('#profile-btn').on('click', function(e) {
        e.preventDefault();
        $('.preloader').css('display', 'block');
        
        document.getElementById('profile-form').submit();
        
        
    });

    $('#removeBackground').on('click',function(){
        $('#removeBackground').html('we removing profile...');
    });

    $('#submit_btn').click(function() {
        $('#submit_btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> wait a moment');
        this.form.submit();
    });

    
    $('#verify-btn').on('click', function(e) {
        e.preventDefault();
        $('#verify-btn').html('<i class="fa fa-spin fa-spinner"></i> wait while..');
        setTimeout(function() {
            document.getElementById('verify-send-form').submit();
        }, 1000);

    });  


    $('#account-btn').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: $('.account-form').attr('action'),
            method: 'POST',
            dataType: 'json',
            data: $('.account-form').serialize(),
            beforeSend: function() {
                $('#account-btn').html('<i class="fa fa-spin fa-spinner"></i> please wait..');
                $('input[name="account_no"]').removeClass('is-invalid');
                $('#account_no').html('');
                $('input[name="bank_name"]').removeClass('is-invalid');
                $('#bank_name').html('');
                $('input[name="branch"]').removeClass('is-invalid');
                $('#branch').html('');
                $('input[name="account_name"]').removeClass('is-invalid');
                $('#account_name').html('');
                $('input[name="ifsc"]').removeClass('is-invalid');
                $('#ifsc').html('');
            },
            success: function(data) {
                $('#account-btn').html('save');
                if (data.ok) {
                    window.location.href = "/home/account";
                    toastr.success(data.ok);
                    $('.account-form')[0].reset();
                }

                if (data.account_no) {
                    $('input[name="account_no"]').addClass('is-invalid');
                    $('#account_no').html(data.bank_name);
                }

                if (data.bank_name) {
                    $('input[name="bank_name"]').addClass('is-invalid');
                    $('#bank_name').html(data.bank_name);
                }
                if (data.branch) {
                    $('input[name="branch"]').addClass('is-invalid');
                    $('#branch').html(data.bank_name);
                }
                if (data.account_name) {
                    $('input[name="account_name"]').addClass('is-invalid');
                    $('#account_name').html(data.bank_name);
                }
                if (data.ifsc) {
                    $('input[name="ifsc"]').addClass('is-invalid');
                    $('#ifsc').html(data.bank_name);
                }

                if (data.er) {
                    $.confirm({
                        title: 'Northern India Tourism Say\'s',
                        content: data.er,
                        type: 'info',
                        typeAnimated: true,
                        buttons: {
                            tryAgain: {
                                text: 'close',
                                btnClass: 'btn-info',
                                close: function() {}
                            }
                        }
                    });
                }


            },
            error: function(xhr, textStatus, errorMessage) {
                $('#account-btn').html('save');
                toastr.error('' + errorMessage + '');
                
            }
        });
    });


    $('#address-btn').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: $('.address-form').attr('action'),
            method: 'POST',
            dataType: 'json',
            data: $('.address-form').serialize(),
            beforeSend: function() {
                $('#address-btn').html('<i class="fa fa-spin fa-spinner"></i> please wait..');
                $('input[name="address_line"]').removeClass('is-invalid');
                $('#address_line').html('');
                $('input[name="state"]').removeClass('is-invalid');
                $('#state').html('');
                $('input[name="city"]').removeClass('is-invalid');
                $('#city').html('');
                $('input[name="postal_code"]').removeClass('is-invalid');
                $('#postal_code').html('');
                $('input[name="country"]').removeClass('is-invalid');
                $('#country').html('');
                
            },
            success: function(data) {
                $('#address-btn').html('save');
                if (data.ok) {
                    window.location.href = "/home/address";
                    toastr.success(data.ok);
                    $('.address-form')[0].reset();                    
                }
                if (data.address_line) {
                    $('input[name="address_line"]').addClass('is-invalid');
                    $('#address_line').html(data.address_line);
                }
                if (data.city) {
                    $('input[name="city"]').addClass('is-invalid');
                    $('#city').html(data.city);
                }
                if (data.city) {
                    $('input[name="country"]').addClass('is-invalid');
                    $('#country').html(data.country);
                }
                
                if (data.postal_code) {
                    $('input[name="postal_code"]').addClass('is-invalid');
                    $('#postal_code').html(data.postal_code);
                }
                if (data.state) {
                    $('input[name="state"]').addClass('is-invalid');
                    $('#state').html(data.state);
                }
                
                if (data.er) {
                    $.confirm({
                        title: 'Something was wrong?',
                        content: data.er,
                        type: 'info',
                        typeAnimated: true,
                        buttons: {
                            tryAgain: {
                                text: 'close',
                                btnClass: 'btn-info',
                                close: function() {}
                            }
                        }
                    });
                }


            },
            error: function(xhr, textStatus, errorMessage) {
                $('#address-btn').html('save');
                toastr.error('' + errorMessage + '');
                
            }
        });
    });

    $('#check_submitPassword').click(function() {
        $.confirm({
            title: 'Confirmation',
            content: 'Do you really want to changes!',
            type: 'dark',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'confirm',
                    btnClass: 'btn-dark',
                    action: function(){
                        $('#check_submitPassword').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> wait a moment');
                        $('.form-password').submit();
                    }
                },
                close: function () {
                }
            }
        });
    });
    $('#check_submit').click(function() {
        $.confirm({
            title: 'Confirmation',
            content: 'Do you really want to changes!',
            type: 'dark',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'confirm',
                    btnClass: 'btn-dark',
                    action: function(){
                        $('#check_submit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> wait a moment');
                        $('.form-profile').submit();
                    }
                },
                close: function () {
                }
            }
        });
    });

    $('input[name="default"]').change(function(){
        this.form.submit();
    });

    function sendMarkRequest(id = null) {
        return $.ajax("/home/clear-all", {
            method: 'POST',
			data: {
                id
            }
        });
    }
    $(function() {
		var notificationsWrapper   = $('.nav-notifications');
		var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
		var notificationsCountElem = $('#count');
		var notificationsCount     = parseInt(notificationsCountElem.data('count'));
		var notifications          = notificationsWrapper.find('div.dropdown-body');

        $(document).on('click','#mark-as-read',function() {
            let request = sendMarkRequest($(this).data('id'));
			var route = $(this).data('url');
			console.log(route);
            request.done(() => {
				window.location.href=route;
            });
        });

        $(document).on('click','#clear-all',function() {
            let request = sendMarkRequest();
            request.done(() => {
				notificationsCountElem.html('No Notifications');
				notifications.html('<a href="javascript:;" class="dropdown-item"><div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg></div><div class="content">No new notifications</div></a>');
				notificationsCountElem.attr('data-count', 0);
				$('#notificationDropdown').html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>');
				notifications.css('height','60px');
				notifications.css('overflow-y','hidden');
            });
        });
    });