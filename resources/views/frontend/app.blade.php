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

<meta name="description" content="Nyati Supreme Construction Materials Ecommerce">
<meta name="keywords" content="Online shop kenya, shop, Construction, cabros, blocks, pave blocks">

<link href="{{ asset('assets/style.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('frontend/cssfiles/images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">

<!-- jQuery -->
<script src="{{ asset('frontend/cssfiles/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="{{ asset('frontend/cssfiles/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('frontend/cssfiles/css/bootstrap.css?v=2.0') }}" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="{{ asset('frontend/cssfiles/fonts/fontawesome/css/all.min.css?v=2.0') }}" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="{{ asset('frontend/cssfiles/css/ui.css?v=2.0') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('frontend/cssfiles/css/responsive.css?v=2.0') }}" rel="stylesheet" type="text/css" />

<!-- fancy box -->
<link href="{{ asset('frontend/cssfiles/plugins/fancybox/fancybox.min.css') }}" rel="stylesheet" type="text/css"/>

<!-- custom javascript -->
<script src="{{ asset('frontend/cssfiles/js/script.js?v=2.0') }}" type="text/javascript"></script>

<script src="{{ asset('vendor/kustomer/js/kustomer.js') }}" defer></script>

</head>
<body>
@include('frontend.partials.header')
@include('frontend.partials.flash-message')
@include('kustomer::kustomer')
@yield('content')
@include('frontend.partials.footer')

@include('frontend.partials.scripts')
</body>
</html>
