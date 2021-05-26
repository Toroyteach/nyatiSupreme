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
<div class="container">
            <div class="">
                <main class="col-sm-12 col-xl-6 col-md-6 col-lg-6">
                    <p class="alert alert-info">Your order was placed successfully. Your order number is : <span>{{ $order->order_number }}<span>.</p>
                </main>
                <br>

                <!-- skip here before going live <style="display:none"> -->
                <main class="col-sm-12 col-xl-6 col-md-6 col-lg-6 successAlert" id="successAlert" style="display:none">
                    <div class="alert alert-success">
                        <h4> Dear {{ Auth::user()->first_name }}</h4> <br>
                        <p>Your payment has been received successfully.</p><br>
                        <p>Your order number is : <span>{{ $order->order_number }}<span>.</p><br>
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
                        <p>Please wait while we finish processing your payment.</p> <br> 
                        <p>Also wait 2 minutes and click here to request another mpesa confirmation</p>
                        <button type="button" class="btn btn-warning btn-sm reSubmitButton" id="reSubmitButton" onClick="requestSubmition()">Request</button><br>
                        <input type="hidden" value="{{ $order->order_number }}" name="orderNumber"></input>
                    </div>
                </main>
            </div>
        </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@stop
@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
      
      <script>

        var successAlert = document.getElementById("successAlert");
        var pendingAlert = document.getElementById("pendingAlert");
    
    //skip here before going live
      init();

         function init(){

            var timerID = setInterval(function() {
                // your code goes here...
                checkPaymentStatus();
            }, 10 * 1000); 

            setTimeout(function() {
                clearInterval(timerID);      
            }, 60000);

         }


         function requestSubmition() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            let BillrefNo = $("input[name=orderNumber]").val();

            //console.log(BillrefNo);

            $.ajax({
               type:'POST',
               url:'/requestMpesa',
               dataType: 'json',
               data:{
                    BilRefNo:BillrefNo,
                    _token:_token,
                },
               success:function(data) {

                   if(data.status){
                    $(".reSubmitButton").prop('disabled', true);

                    setTimeout(function() {
                        $(".reSubmitButton").removeAttr("disabled");      
                    }, 180000);

                    console.log(data.success);

                   } else {
                    console.log(data.message);
                    $(".reSubmitButton").prop('disabled', true);
                   }

               }

            });
         }

         function checkPaymentStatus(){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let BillrefNo = $("input[name=orderNumber]").val();

            console.log(BillrefNo);

            $.ajax({
               type:'POST',
               url:'/requestOrderPaymentConfirmation',
               dataType:'json',
               data:{
                    BilRefNo:BillrefNo,
                    _token:_token,
                },
               success:function(odata) {

                    //console.log(odata);
                    if(odata.status){
                     pendingAlert.style.display = "none";
                     successAlert.style.display = "block";
                        //console.log(odata.success);
                    } else {
                        console.log(odata.failure);
                    }        
               }

            });
         }
      </script>

@endpush