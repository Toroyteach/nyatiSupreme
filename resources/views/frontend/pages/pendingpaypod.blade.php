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

                
                <main class="col-sm-12 successAlert" style="">
                    <div class="alert alert-success">
                        <h4> Dear {{ Auth::user()->first_name }}</h4> <br>
                        <p>Your payment has been processed successfully.</p><br>
                        <p>Your order number is : <span>{{ $order->order_number }}<span>.</p><br>
                        <p>Thank you for shooping with us.</p><br>
                        <p>Nyati Supreme Team.</p><br>
                        <a class="btn btn-primary btn-sm" href="{{ route('account.orders') }}">View Order</a>
                    </div>
                </main>

            </div>
        </div> <!-- container .//  -->

</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@stop