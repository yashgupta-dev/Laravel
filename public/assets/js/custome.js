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

    $(document).on('click','#extrathingsID',function(){
        var id = $(this).attr('data-id');
        $('.idshow').html(id);
        $('.inputID').html('<input type="hidden" value="'+ id +'" name="id">');
        $.ajax({
            url: '/admin/create/form/slider',
            data:{'id':id},
            method: 'Post',
            dataType:'json',
            cache:false,
            beforeSend:function(){
                $('#form_main').html('<div class="text-center"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></div>');
            },
            success:function(res){
                $('#form_main').html(res.ok);
            },
            error:function(xhr, error){
                toastr.warning(res.error);
            }
        });
    });

    $(document).on('click','#clickToSave',function(e){
        e.preventDefault();
        $.ajax({
            url: $('.formSlider').attr('action'),
            method: $('.formSlider').attr('method'),
            data: $('.formSlider').serialize(),
            dataType:'json',
            cache:false,
            beforeSend:function(){
                $('#clickToSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> wait a moment');
                $('input[name="title"]').removeClass('is-invalid');
                $('input[name="link"]').removeClass('is-invalid');
                $('#descTitle').removeClass('is-invalid');
            },
            success:function(res){
                $('#clickToSave').html('save changes');
                console.log(res);
                if(res.link){
                    $('input[name="link"]').addClass('is-invalid');
                }
                if(res.title){
                    $('input[name="title"]').addClass('is-invalid');
                }
                if(res.id){
                    toastr.warning(res.id);
                }
                if(res.btndesign){
                    toastr.warning(res.btndesign);
                }
                if(res.textBtn){
                    toastr.warning(res.textBtn);
                }
                if(res.desc){
                    $('#descTitle').addClass('is-invalid');
                }
                if(res.ok){
                    $('.formSlider')[0].reset();
                    toastr.success(res.ok);
                }
                if(res.er){
                    toastr.warning(res.er);
                }
            },
            error:function(xhr, error){
                $('#clickToSave').html('save changes');
                toastr.warning(res.error);
            }
        });
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
    $("input[name='logochange']").change(function(e) {
        var show = $(this).attr('data-type').split('|')[0];
        var url = $(this).attr('data-type').split('|')[1];
        var reader = new FileReader();
            reader.onload = function(e) {
                $('.logo-view').css('background','#fff');
                $('#'+show).attr('src', e.target.result);
            
            }
            reader.readAsDataURL(this.files[0]); // convert to base64 string
    
        var data = new FormData();
        data.append('image', $('input[name="logochange"]')[0].files[0]);
        $.ajax({
                url:url,
                type: 'post',
                data : data,
                enctype : 'multipart/form-data',
                contentType: false,
                processData: false,
                // dataType:'json',
                success: function( data ) {
                    if(data.ok){
                        toastr.success(data.ok);
                    }
                    if(data.image){
                        toastr.warning(data.image);
                    }
                    // var baseUrl = "{{asset('')}}";
                    // var imageUrl = baseUrl + data.msg;
                    // $('#changeimage').html('<img src="'+ imageUrl +'" height="120px" width="150px">');
                },
                error: function(xhr,error) {
                    toastr.warning(error);
                }
           });   
    });

    $("input[name='faviconChange']").change(function(e) {

            var show = $(this).attr('data-type').split('|')[0];
            var url = $(this).attr('data-type').split('|')[1];
            var reader = new FileReader();
                reader.onload = function(e) {
                    $('.logo-view1').css('background','#fff');
                    $('#'+show).attr('src', e.target.result);
                
                }
                reader.readAsDataURL(this.files[0]); // convert to base64 string
        
            var data = new FormData();
            data.append('image', $('input[name="faviconChange"]')[0].files[0]);
            $.ajax({
                    url:url,
                    type: 'post',
                    data : data,
                    enctype : 'multipart/form-data',
                    contentType: false,
                    processData: false,
                    // dataType:'json',
                    success: function( data ) {
                        if(data.ok){
                            toastr.success(data.ok);
                        }
                        if(data.image){
                            toastr.warning(data.image);
                        }
                        // var baseUrl = "{{asset('')}}";
                        // var imageUrl = baseUrl + data.msg;
                        // $('#changeimage').html('<img src="'+ imageUrl +'" height="120px" width="150px">');
                    },
                    error: function(xhr,error) {
                        toastr.warning(error);
                    }
               });   
    });
    
    Dropzone.options.myAwesomeDropzone = {
                autoProcessQueue: true,
                uploadMultiple: true,
                parallelUploads: 10,
                addRemoveLinks: true,
                successmultiple: function(data, response) {
                    if(response.ok){
                        $.confirm({
                            title: response.title,
                            content: response.ok,
                            type: 'blue',
                            typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: 'Close',
                                    btnClass: 'btn-blue',
                                    action: function() {
                                        location.reload();
                                    }
                                }
                            }
                        }); 
                    }
                    if(response.er){
                        $.confirm({
                            title: 'Oops! something went wrong?',
                            content: JSON.stringify(response.er),
                            type: 'blue',
                            typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: 'Close',
                                    btnClass: 'btn-blue',
                                    close: function() {}
                                }
                            }
                        });
                    }
                },
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
                },
        
    };

    function sendMarkRequest(id = null) {
        return $.ajax("/admin/clear-all", {
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

    function getURLVar(key) {
        var value = [];
    
        var query = String(document.location).split('?');
    
        if (query[1]) {
            var part = query[1].split('&');
    
            for (i = 0; i < part.length; i++) {
                var data = part[i].split('=');
    
                if (data[0] && data[1]) {
                    value[data[0]] = data[1];
                }
            }
    
            if (value[key]) {
                return value[key];
            } else {
                return '';
            }
        }
    }
    
    $(document).ready(function() {
        //Form Submit for IE Browser
        $('button[type=\'submit\']').on('click', function() {
            $("form[id*='form-']").submit();
        });
    
        // Highlight any found errors
        $('.text-danger').each(function() {
            var element = $(this).parent().parent();
    
            if (element.hasClass('form-group')) {
                element.addClass('has-error');
            }
        });
    
        // tooltips on hover
        $('[data-toggle=\'tooltip\']').tooltip({container: 'body', html: true});
    
        // Makes tooltips work on ajax generated content
        $(document).ajaxStop(function() {
            $('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
        });
    
        // https://github.com/opencart/opencart/issues/2595
        $.event.special.remove = {
            remove: function(o) {
                if (o.handler) {
                    o.handler.apply(this, arguments);
                }
            }
        }
        
        // tooltip remove
        $('[data-toggle=\'tooltip\']').on('remove', function() {
            $(this).tooltip('destroy');
        });
    
        // Tooltip remove fixed
        $(document).on('click', '[data-toggle=\'tooltip\']', function(e) {
            $('body > .tooltip').remove();
        });
        
        $('#button-menu').on('click', function(e) {
            e.preventDefault();
            
            $('#column-left').toggleClass('active');
        });
    
        // Set last page opened on the menu
        $('#menu a[href]').on('click', function() {
            sessionStorage.setItem('menu', $(this).attr('href'));
        });
    
        if (!sessionStorage.getItem('menu')) {
            $('#menu #dashboard').addClass('active');
        } else {
            // Sets active and open to selected page in the left column menu.
            $('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parent().addClass('active');
        }
        
        $('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('li > a').removeClass('collapsed');
        
        $('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('ul').addClass('in');
        
        $('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('li').addClass('active');
        
        // Image Manager
        $(document).on('click', 'a[data-toggle=\'image\']', function(e) {
            var $element = $(this);
            var $popover = $element.data('bs.popover'); // element has bs popover?
    
            e.preventDefault();
    
            // destroy all image popovers
            $('a[data-toggle="image"]').popover('destroy');
    
            // remove flickering (do not re-add popover when clicking for removal)
            if ($popover) {
                return;
            }
    
            $element.popover({
                html: true,
                placement: 'right',
                trigger: 'manual',
                content: function() {
                    return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
                }
            });
    
            $element.popover('show');
    
            $('#button-image').on('click', function() {
                var $button = $(this);
                var $icon   = $button.find('> i');
    
                $('#modal-image').remove();
    
                $.ajax({
                    url: 'index.php?route=common/filemanager&user_token=' + getURLVar('user_token') + '&target=' + $element.parent().find('input').attr('id') + '&thumb=' + $element.attr('id'),
                    dataType: 'html',
                    beforeSend: function() {
                        $button.prop('disabled', true);
                        if ($icon.length) {
                            $icon.attr('class', 'fa fa-circle-o-notch fa-spin');
                        }
                    },
                    complete: function() {
                        $button.prop('disabled', false);
    
                        if ($icon.length) {
                            $icon.attr('class', 'fa fa-pencil');
                        }
                    },
                    success: function(html) {
                        $('body').append('<div id="modal-image" class="modal">' + html + '</div>');
    
                        $('#modal-image').modal('show');
                    }
                });
    
                $element.popover('destroy');
            });
    
            $('#button-clear').on('click', function() {
                $element.find('img').attr('src', $element.find('img').attr('data-placeholder'));
    
                $element.parent().find('input').val('');
    
                $element.popover('destroy');
            });
        });
    });
    
    // Autocomplete */
    (function($) {
        $.fn.autocomplete = function(option) {
            return this.each(function() {
                console.log(option);
                console.log($(this));
                var $this = $(this);
                var $dropdown = $('<ul class="dropdown-menu" />');
    
                this.timer = null;
                this.items = [];
    
                $.extend(this, option);
    
                $this.attr('autocomplete', 'off');
    
                // Focus
                $this.on('focus', function() {
                    this.request();
                });
    
                // Blur
                $this.on('blur', function() {
                    setTimeout(function(object) {
                        object.hide();
                    }, 200, this);
                });
    
                // Keydown
                $this.on('keydown', function(event) {
                    switch(event.keyCode) {
                        case 27: // escape
                            this.hide();
                            break;
                        default:
                            this.request();
                            break;
                    }
                });
    
                // Click
                this.click = function(event) {
                    event.preventDefault();
    
                    var value = $(event.target).parent().attr('data-value');
    
                    if (value && this.items[value]) {
                        this.select(this.items[value]);
                    }
                }
    
                // Show
                this.show = function() {
                    var pos = $this.position();
    
                    $dropdown.css({
                        top: pos.top + $this.outerHeight(),
                        left: pos.left
                    });
    
                    $dropdown.show();
                }
    
                // Hide
                this.hide = function() {
                    $dropdown.hide();
                }
    
                // Request
                this.request = function() {
                    clearTimeout(this.timer);
    
                    this.timer = setTimeout(function(object) {
                        object.source($(object).val(), $.proxy(object.response, object));
                    }, 200, this);
                }
    
                // Response
                this.response = function(json) {
                    console.log(json);
                    var html = '';
                    var category = {};
                    var name;
                    var i = 0, j = 0;
    
                    if (json.length) {
                        for (i = 0; i < json.length; i++) {
                            // update element items
                            this.items[json[i]['value']] = json[i];
    
                            if (!json[i]['category']) {
                                // ungrouped items
                                html += '<li style="margin: 15px;" data-value="' + json[i]['value'] + '">';
                                if(json[i]['image'] != undefined ){
                                    html +='<img src="'+json[i]['image']+'" style="width:20px; height:20px; border-radius:50px; background-size:cover;">';
                                }
                                html +='<a style="padding: 15px;color: #434343;" href="#" class="font-weight-bold">' + json[i]['label'] + '</a>';
                                if(json[i]['email'] != undefined ){
                                    html +='<p class="text-center font-weight-light">'+json[i]['email']+'</p>';
                                }
                                html+='</li>';
                                
                            } else {
                                // grouped items
                                name = json[i]['category'];
                                if (!category[name]) {
                                    category[name] = [];
                                }
    
                                category[name].push(json[i]);
                            }
                        }
    
                        for (name in category) {
                            html += '<li class="dropdown-header">' + name + '</li>';
    
                            for (j = 0; j < category[name].length; j++) {
                                html += '<li style="margin: 15px;" data-value="' + category[name][j]['value'] + '"><a style="padding: 15px;color: #434343;" href="#">&nbsp;&nbsp;&nbsp;' + category[name][j]['label'] + '</a></li>';
                            }
                        }
                    }
    
                    if (html) {
                        this.show();
                    } else {
                        this.hide();
                    }
    
                    $dropdown.html(html);
                }
    
                $dropdown.on('click', '> li > a', $.proxy(this.click, this));
                $this.after($dropdown);
            });
        }
    })(window.jQuery);
    