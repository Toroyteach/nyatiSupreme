<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') - {{ config('app.name') }}</title>
<meta charset="utf-8">

<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta name="description" content="{{ config('settings.seo_meta_description') }}">
<meta name="keywords" content="{{ config('settings.seo_meta_title') }}">

<link href="{{ asset('assets/style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/frontend/cssfiles/custome.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('frontend/cssfiles/images/nyati/catalogue/nyati_logo.png') }}" rel="shortcut icon" type="image/x-icon">

<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->

<!-- Bootstrap4 files-->
<!-- <script src="{{ asset('/frontend/cssfiles/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script> -->
<link href="{{ asset('/frontend/cssfiles/css/bootstrap.css?v=2.0') }}" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="{{ asset('/frontend/cssfiles/fonts/fontawesome/css/all.min.css?v=2.0') }}" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="{{ asset('/frontend/cssfiles/css/ui.css?v=2.0') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/frontend/cssfiles/css/responsive.css?v=2.0') }}" rel="stylesheet" type="text/css" />

<!-- fancy box -->
<link href="{{ asset('/frontend/cssfiles/plugins/fancybox/fancybox.min.css') }}" rel="stylesheet" type="text/css"/>

<!-- custom javascript -->
<!-- <script src="{{ asset('/frontend/cssfiles/js/script.js?v=2.0') }}" type="text/javascript"></script> -->

<script src="{{ asset('/vendor/kustomer/js/kustomer.js') }}" defer></script>

<!-- plugin: slickslider -->
<link href="{{ asset('/frontend/cssfiles/plugins/slickslider/slick.css') }} " rel="stylesheet" type="text/css" />
<link href="{{ asset('/frontend/cssfiles/plugins/slickslider/slick-theme.css') }}" rel="stylesheet" type="text/css" />
<!-- <script src="{{ asset('/frontend/cssfiles/plugins/slickslider/slick.min.js') }}"></script> -->

<!-- plugin: owl carousel  -->
<!-- <link href="{{ asset('/frontend/cssfiles/plugins/owlcarousel/assets/owl.carousel.css') }}" rel="stylesheet">
<link href="{{ asset('/frontend/cssfiles/plugins/owlcarousel/assets/owl.theme.default.css') }}" rel="stylesheet">
<script src="{{ asset('/frontend/cssfiles/plugins/owlcarousel/owl.carousel.min.js') }}"></script> -->


<style>
.kustomer-feedback-component{
    z-index: 1000 !important;
}

/* body {
  background-image: url("{{ asset('frontend/cssfiles/images/nyati/catalogue/logo.png') }}");
  max-height: 10px;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
} */

 /* Small devices (landscape phones, 375px and down) */
@media only screen and (max-width: 574.98px) and (min-width: 359.98px) { 
    .catalogue img{
      /* display: none; */
    }

    .bannersection h3{
      font-size: 1.3rem;
    }

    .bannersection p{
      font-size: .9rem;
    }

    .catalogueimg img{
      float: none !important;
    }

    .catalogueimg p{
      padding-top: 10px;
    }
 }
 

 /* Small devices (landscape phones, 576px and down) */
 @media (max-width: 575.98px) { 
    .catalogue>.responsive{
      display: none;
      top: -10px !important;
      left: 80px;
      position: relative;
      height: 100px;
      width: auto;
    }
 }

  /* Medium devices (tablets, 768px and down) */
@media (max-width: 767.98px) { 
  .catalogue>.responsive{
    display: none;
      /* top: -10px !important; */
      /* position: relative; */
      left: 30px;
      height: 30% !important;
      width: auto;
    }
 }

 /* Large devices (desktops, 992px and down) */
@media (max-width: 991.98px) { 
  .catalogue>.responsive{
    bottom: 12px;
    height:20%;
    width:auto;
    left:0px;
  }
 }

  /* Large devices (desktops, 992px and up) */
@media (min-width: 992px) { 
  .catalogue>.responsive{
    bottom: 12px;
    height:30%;
    width:auto;
    left:0px;
  }
 }

</style>

</head>
<body>
@include('frontend.partials.header2')
@include('frontend.partials.flash-message')
@include('kustomer::kustomer')
@yield('content')
@include('frontend.partials.footer')
@include('frontend.partials.scripts')
</body>
</html>
