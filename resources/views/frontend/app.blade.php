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

<link href="{{ config('settings.site_favicon') }}" rel="shortcut icon" type="image/x-icon">

<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->

<!-- Bootstrap4 files-->
<script src="{{ asset('/frontend/cssfiles/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('/frontend/cssfiles/css/bootstrap.css?v=2.0') }}" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="{{ asset('/frontend/cssfiles/fonts/fontawesome/css/all.min.css?v=2.0') }}" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="{{ asset('/frontend/cssfiles/css/ui.css?v=2.0') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/frontend/cssfiles/css/responsive.css?v=2.0') }}" rel="stylesheet" type="text/css" />

<!-- fancy box -->
<link href="{{ asset('/frontend/cssfiles/plugins/fancybox/fancybox.min.css') }}" rel="stylesheet" type="text/css"/>

<!-- custom javascript -->
<script src="{{ asset('/frontend/cssfiles/js/script.js?v=2.0') }}" type="text/javascript"></script>

<script src="{{ asset('/vendor/kustomer/js/kustomer.js') }}" defer></script>

<style>
.kustomer-feedback-component{
    z-index: 1000 !important;
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
