@extends('frontend.app')
@section('content')
    <!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
<div class="container">
	<h2 class="title-page">Pending Order</h2>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION PAGETOP END// ========================= -->
	
<!-- ========================= SECTION CONTENT ========================= -->
<br>
<section class="section-content bg border-top">
        <div class="container">
            <div class="row">

            </div>
        </div> <!-- container .//  -->

        <div class="container">
            <div class="embed-responsive embed-responsive-16by9">
                <div class="embed-responsive-item">
                        {!! $iframe !!}
                </div>
            </div>
        </div>
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@stop