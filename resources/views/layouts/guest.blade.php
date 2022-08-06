@section('header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Setup Installation | By - AV Digietech</title>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('logo/placeholder/favicon.png') }}" rel="icon">
    <!-- core:css -->
    <style type="text/css">
        .logo img{width: 60px;height: 60px;object-fit: cover;border-radius: 100px;}.logo p {position: absolute;top: 45px;left: 95px;font-size: 19px;font-weight: 600;}.logo small {position: absolute;top: 62px;left: 137px;font-size: 10px;font-weight: 600;/* color: azure; */border-bottom: 1px solid #e4945a;}input.form-control {border-radius: 50px;}
    </style>
    <link rel="stylesheet" href="{{asset('assets/vendors/core/core.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo_5/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo_5/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo_5/tooltips.css')}}">
</head>
<body>
@show
@section('content')

@show
@section('footer')
<!-- core:js -->
<script src="{{asset('assets/vendors/core/core.js')}}"></script>
<!-- plugin js for this page -->
<script src="{{asset('assets/js/template.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.4.1.js')}}"></script>
<script src="{{asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
<script type="text/javascript">
    $("input[type='file']").change(function(e) {

    var show = $(this).attr('data-type');
    var reader = new FileReader();
        reader.onload = function(e) {
            $('#'+show).attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]); // convert to base64 string

    });
    $('#submit_btn').click(function() {
        $('#submit_btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> installing...');
        this.form.submit();
    });
</script>
</body>
</html>
@show