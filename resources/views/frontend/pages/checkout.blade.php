@extends('frontend.app')
@section('content')

<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page"> Checkout </h2>
	<nav>
	{{ Breadcrumbs::render('checkout') }}
	</nav>
</div> <!-- container //  -->
</section>
    <!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container" style="max-width: 720px;">
	<form action="{{ route('checkout.place.order') }}" name="myform" method="POST" role="form" id="submitform">
	  	@csrf
<div class="card mb-4">
      <div class="card-body">
      <h4 class="card-title mb-3">Delivery information</h4>
		
		<br>
		<!-- //skip here before going live -->
		<h5 class="title">Payment Option</h5>
	  <div class="form-row">
			<div class="form-group col-sm-4">
				<label class="js-check box active">
					<input type="radio" name="payment_method" id="mpesa" onclick="my_function(this)" value="mpesa" required>
					<h6 class="title">Mpesa</h6>
				</label> 
			</div>
			<div class="form-group col-sm-4">
				<label class="js-check box">
					<input type="radio" name="payment_method" id="other" onclick="my_function(this)" value="other" required>
					<h6 class="title">Other Payments</h6>
				</label> 
			</div>
			<div class="form-group col-sm-4">
				<label class="js-check box">
					<input type="radio" name="payment_method" id="cash" onclick="my_function(this)" value="cash" required>
					<h6 class="title">Cash Delivery</h6>
				</label> 
			</div>
		</div>
		<!-- <input type="hidden" name="payment_method" id="mpesa" value="nopaymentset" required> -->


		<br>
		<h5 class="title">Confirm Details</h5>
	<div class="form-row">
		<div class="col form-group">
			<label>First name</label>
		  	<input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{Auth::user()->first_name}}" required>
		</div> <!-- form-group end.// -->
		<div class="col form-group">
			<label>Last name</label>
		  	<input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{Auth::user()->last_name}}" required>
		</div> <!-- form-group end.// -->
	</div> <!-- form-row end.// -->

	<div class="form-row">
		<div class="col form-group">
			<label>Email</label>
		  	<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{Auth::user()->email}}" required disabled>
		</div> <!-- form-group end.// -->
		<div class="col form-group">
			<label>Phone</label>
		  	<input type="number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{Auth::user()->phonenumber}}" required disabled>
		</div> <!-- form-group end.// -->
	</div> <!-- form-row end.// -->

	<div class="form-row">
		<div class="form-group col-md-6">
		  <label>Address</label>
		  <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{Auth::user()->address}}" required>
		</div> <!-- form-group end.// -->
		<div class="form-group col-md-6">
		  <label>Post Code</label>
		  <input type="text" name="post_code" class="form-control @error('post_code') is-invalid @enderror" value="{{Auth::user()->post_code}}" required>
		</div> <!-- form-group end.// -->
	</div> <!-- form-row.// -->

	<div class="form-row">
		<div class="form-group col-md-6">
		  <label>Country</label>
		  <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" value="{{Auth::user()->country}}" required>
		</div> <!-- form-group end.// -->
		<div class="form-group col-md-6">
		  <label>City</label>
		  <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{Auth::user()->city}}" required>
		</div> <!-- form-group end.// -->
	</div> <!-- form-row.// -->

	<div class="form-group">
		<label>Shipping Notes</label>
       <textarea class="form-control" rows="2" id="notes" name="notes" form="submitform"></textarea>
    </div> <!-- form-group// -->  

      </div> <!-- card-body.// -->
    </div>  <!-- card .// -->


		<div class="card mb-4">

			<div class="card-body" id="mpesaPayment" style="">
			<h4 class="card-title mb-4">Mpesa</h4>
					<div class="form-group">
					<label for="username" data-toggle="tooltip" title="Only safaricom numbers allowed!!">Phone number <i class="fa fa-question-circle"></i></label>
					<input type="text" class="form-control @error('mpesaPhonenumber') is-invalid @enderror" id="mnumber" value="{{ Auth::user()->phonenumber}}" name="mpesaPhonenumber" placeholder="Enter your Mobile number" onblur="validateNumber()" required >
					</div> <!-- form-group.// -->
			</div> <!-- card-body.// -->



			<div class="card-body" id="creditCard" style="display:none;">
    			    <h4 class="card-title mb-4">Other Payments</h4>

					<div class="row">
						<p class="lead"> Credit Card, Visa, Mobile Banking, </p>
					</div> <!-- row.// -->
				</div> <!-- card-body.// -->
				
    			<div class="card-body" id="cashDelivery" style="display:none;">
    			    <h4 class="card-title mb-4">Cash on Delivery</h4>

					<div class="row">
						<p class="lead"> Make Cash Payment on Delivery </p>
					</div> <!-- row.// -->
				</div> <!-- card-body.// -->
				
			</div> <!-- card .// -->
			
			<div class="card-body">
				<ul class="list-group mb-3">
					<li class="list-group-item d-flex justify-content-between">
						<span>Total</span>
						<strong>{{ config('settings.currency_symbol').' '.$total }}</strong>
					</li>
				</ul>
			</div>


		<button class="btn btn-primary btn-block submitbtn" type="submit" id="submitButton">
			<!-- <span class="spinner-grow spinner-grow-sm" role="status" style="display:none;" aria-hidden="true"></span> -->
				Make Order
		</button>
				</form>

<br>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

@stop
@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script> 

function validateNumber()
{
	
	if (document.getElementById('mpesa').checked) {
		
		var x = document.forms["submitform"]["mpesaPhonenumber"].value;

		var choiceChecked = /(\+?254|0|^){1}[-. ]?([7]{1}([0-2]{1}[0-9]{1}|[4]{1}([0-3]{1}|[5-6]{1})|[5]{1}[7-9]{1}|[6]{1}[8-9]{1}|[9]{1}[0-9]{1})|[1]{2}[0-5]{1})[0-9]{6}/.test(x);
		
		if(choiceChecked){

			return true;

		} else {

			swal("Please input Valid Safaricom phone numbers!");
			return false;

		}
	}

}

function my_function(elm){

	document.getElementById('creditCard').style.display = "none";
	document.getElementById('mpesaPayment').style.display = "none";
	document.getElementById('cash').style.display = "none";

    if(elm == document.getElementById('mpesa')){

            document.getElementById('cashDelivery').style.display = "none";
			document.getElementById('creditCard').style.display = "none";
			document.getElementById('mpesaPayment').style.display = "block";
		} else if(elm == document.getElementById('other')){

			document.getElementById('mpesaPayment').style.display = "none";
			document.getElementById('creditCard').style.display = "block";
			document.getElementById('cashDelivery').style.display = "none";
		} else if(elm == document.getElementById('cash')){

			document.getElementById('cashDelivery').style.display = "block";
			document.getElementById('mpesaPayment').style.display = "none";
			document.getElementById('creditCard').style.display = "none";
		}
}

    </script>
@endpush