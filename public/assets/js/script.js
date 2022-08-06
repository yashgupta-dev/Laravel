
    /*===================================*
    01. LOADING JS
    /*===================================*/
    $(window).on('load', function() {
        setTimeout(function() {
            $(".preloader").delay(700).fadeOut(700).css('display','none');
        }, 100);
    });

    $('#login-btn').on('click', function(e) {
        e.preventDefault();
        $('.preloader').css('display', 'block');
        setTimeout(function() {
            document.getElementById('login-form').submit();
        }, 1000);
        
    });

    
    $('#register-btn').on('click', function(e) {
        e.preventDefault();
        $('.preloader').css('display', 'block');
        setTimeout(function() {
            document.getElementById('register-form').submit();
        }, 1000);
        
    });

    $('#reset-btn').on('click', function(e) {
        e.preventDefault();
        $('.preloader').css('display', 'block');
        setTimeout(function() {
            document.getElementById('reset-form').submit();
        }, 1000);
        
    });
    $('#forget-btn').on('click', function(e) {
        e.preventDefault();
        $('.preloader').css('display', 'block');
        setTimeout(function() {
            document.getElementById('forget-form').submit();
        }, 1000);
        
    });

    
