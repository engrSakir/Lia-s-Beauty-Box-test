<!-- META -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="{{ config('app.name') }}">
<meta name="author" content="{{ config('app.name') }}">
<meta name="keywords" content="" />
<meta name="robots" content="" />
<!-- FAVICONS ICON -->
<link rel="icon" href="{{ asset('assets/frontend/images/favicon.html') }}" type="image/x-icon" />
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/images/favicon.png') }}" />

<!-- PAGE TITLE HERE -->
<title> @stack('title') - {{ config('app.name') }} </title>

<!-- MOBILE SPECIFIC -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- [if lt IE 9]>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<![endif] -->

<!-- BOOTSTRAP STYLE SHEET -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
<!-- FONTAWESOME STYLE SHEET -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/fontawesome/css/font-awesome.min.css') }}"/>
<!-- FLATICON STYLE SHEET -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/flaticon.min.css') }}">
<!-- ANIMATE STYLE SHEET -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/animate.min.css') }}">
<!-- OWL CAROUSEL STYLE SHEET -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}">
<!-- BOOTSTRAP SELECT BOX STYLE SHEET -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap-select.min.css') }}">
<!-- MAGNIFIC POPUP STYLE SHEET -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/magnific-popup.min.css') }}">
<!-- LOADER STYLE SHEET -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/loader.min.css') }}">
<!-- MAIN STYLE SHEET -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/style.css') }}">
<!-- THEME COLOR CHANGE STYLE SHEET -->
<link rel="stylesheet" class="skin" type="text/css" href="{{ asset('assets/frontend/css/skin/skin-1.css') }}">
<!-- CUSTOM  STYLE SHEET -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/custom.css') }}">
<!-- SIDE SWITCHER STYLE SHEET -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/switcher.css') }}">


<!-- REVOLUTION SLIDER CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/plugins/revolution/revolution/css/settings.css') }}">
<!-- REVOLUTION NAVIGATION STYLE -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/plugins/revolution/revolution/css/navigation.css') }}">

<!-- HELPER STYLE -->
<link rel="stylesheet" type="text/css" href="{{ asset("assets/css/helper.css") }}">

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!--====== AJAX ======-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
@media only screen and (max-width: 768px) {
    .topemail{
   display:none;
 }
}
</style>
@toastr_css
<!--Page Lavel code -->
@stack('head')
<style>
    @media screen and (min-width: 0px) and (max-width: 997px) {
        .show_on_desktop_only {
            display: none;
        }

        /* hide it elsewhere */
    }
</style>
