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
<section class="section-content bg padding-y border-top">
    <div class="container-fluid d-flex justify-content-center">
            <div class="container">
                <main class="col-sm-12 col-xl-6 col-md-6 col-lg-6">
                    <p class="alert alert-info">Your order was placed successfully. Your order number is : <span>{{ $order->order_number }}<span>.</p>
                </main>
                <br>

                <!-- skip here before going live <style="display:none"> -->
                <main class="col-sm-12 col-xl-6 col-md-6 col-lg-6 successAlert" id="successAlert" style="display:none">
                    <div class="alert alert-success">
                        <h4> Dear {{ Auth::user()->first_name }}</h4> <br>
                        <p>Your payment has been received successfully.</p><br>
                        <p>Your order number is : <span>{{ \Illuminate\Support\Str::limit($order->order_number, 26) }}<span>.</p><br>
                        <p>Thank you for shooping with us.</p><br>
                        <p>Nyati Supreme Team.</p><br>
                        <a class="btn btn-primary btn-sm" href="{{ route('account.orders') }}">View Order</a>
                    </div>
                </main>

                <!-- skip here before going live -->
                <main class="col-sm-12 col-xl-6 col-md-6 col-lg-6" id="pendingAlert">

                    <div class="spinner-border m-5" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="alert alert-warning pendingAlert">
                        <p>Please wait while we finish processing your payment..</p> <br> 
                        <p>Please Go to Mpesa <br>=> Lipa na Mpesa <br>=> Paybill Number use {{env('MPESA_LIVE_SHORT_CODE')}} <br>=> Account Number use {{\Illuminate\Support\Str::substr($order->order_number, 20, 26)}} <br>=> Amount is {{ config('settings.currency_symbol') }}{{$order->grand_total}} </p>
                        <p>You can also click here to request us to initiate the payment session for you in your phone</p>
                        <button type="button" class="btn btn-warning btn-sm reSubmitButton" id="reSubmitButton" onClick="stkPush()">Request</button><br>
                        <!-- change the onClick of the requestSTKpush -->
                        <input type="hidden" value="{{ $order->order_number }}" name="orderNumber"></input>
                    </div>
                </main>
            </div>
        </div> <!-- container .//  -->
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" data-backdrop="static" data-keyboard="false"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Payment Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          We have sent a payment request on your Phone please <br>complete the transaction to continue enjoying our services.
        </div>
          <div class="d-flex justify-content-center">
              <div class="spinner-border " role="status">
                <span class="sr-only">Loading...</span>
              </div>
          </div><br>

          <div class="alert alert-warning" id="modalFailedUi" style="display:none">
              <h4> Dear {{ Auth::user()->first_name }}</h4> <br>
              <p>Your payment request was not processed successfully.</p><br>
              <p>Please Contact our support team for more assistance.</p><br>
              <a class="btn btn-primary btn-sm" href="{{ route('contact') }}">NyatiSupreme Team.</a>
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modalClose">Close</button>
          <button type="button" class="btn btn-primary">Finish</button>
        </div>

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="failureResponseModal" data-backdrop="static" data-keyboard="false"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Dear {{ Auth::user()->first_name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="alert alert-warning" id="modalFailedUi">
            <p>Your payment request was not processed successfully.</p><br>
            <p>Please Contact our support team for more assistance.</p><br>
            <p>You can try and request the payment Again.</p><br>
            <a class="btn btn-primary btn-sm" href="{{ route('contact') }}">NyatiSupreme Team.</a>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modalClose">Close</button>
        <button type="button" class="btn btn-primary" onClick="stkRequest()">Request Payment</button>
      </div>
    </div>
  </div>
</div>
<!-- ========================= SECTION CONTENT END// ========================= -->
@stop
@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('frontend/cssfiles/js/payment.js') }}"></script>
@endpush