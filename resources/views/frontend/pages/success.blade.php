@extends('frontend.app')
@section('title', 'Order Completed')
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Order Completed</h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top">
<div class="container">
            <div class="row">

                <main class="col-sm-12 successAlert">
                    <div class="alert alert-success">
                        <h4> Dear {{ Auth::user()->first_name }}</h4> <br>
                        <p>Your payment status has been received.</p><br>
                        <p>Your order number is : <span>{{ $order->order_number }}<span>.</p><br>
                        <p>Thank you for shooping with us. We shall send you confirmation once payment is successfull</p><br>
                        <p>Nyati Supreme Team.</p><br>
                        <a class="btn btn-primary btn-sm" href="{{ route('account.orders') }}">View Order</a>
                    </div>
                </main>

            </div>
        </div> <!-- container .//  -->
</section>
@stop
