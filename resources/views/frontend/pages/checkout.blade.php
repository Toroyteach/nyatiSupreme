@extends('frontend.app')
@section('content')

    <!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container" style="max-width: 720px;">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                </div>
            </div>

<div class="card mb-4">
      <div class="card-body">
      <h4 class="card-title mb-3">Delivery information</h4>
		
		<br>
		<h5 class="title">Payment Option</h5>
	  <div class="form-row">
			<div class="form-group col-sm-6">
				<label class="js-check box active">
					<input type="radio" name="paymentOption" value="option1" checked>
					<h6 class="title">Mpesa</h6>
				</label> <!-- js-check.// -->
			</div>
			<div class="form-group col-sm-6">
				<label class="js-check box">
					<input type="radio" name="paymentOption" value="option1">
					<h6 class="title">Credit Card</h6>
				</label> <!-- js-check.// -->
			</div>
		</div> <!-- form row.// -->

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
       <textarea class="form-control" rows="2" name="notes"></textarea>
    </div> <!-- form-group// -->  

      </div> <!-- card-body.// -->
    </div>  <!-- card .// -->


		<div class="card mb-4">
      <div class="card-body">
      <h4 class="card-title mb-4">Payment</h4>

			<div class="form-group">
			<label for="username">Name on card</label>
			<input type="text" class="form-control" name="username" placeholder="Ex. John Smith" required="">
			</div> <!-- form-group.// -->

			<div class="form-group">
			<label for="cardNumber">Card number</label>
			<div class="input-group">
				<input type="text" class="form-control" name="cardNumber" placeholder="">
				<div class="input-group-append">
					<span class="input-group-text">
						<i class="fab fa-cc-visa"></i> &nbsp; <i class="fab fa-cc-amex"></i> &nbsp; 
						<i class="fab fa-cc-mastercard"></i> 
					</span>
				</div>
			</div> <!-- input-group.// -->
			</div> <!-- form-group.// -->

			<div class="row">
				<div class="col-md flex-grow-0">
					<div class="form-group">
						<label class="hidden-xs">Expiration</label>
						<div class="form-inline" style="min-width: 220px">
							<select class="form-control" style="width:100px">
								<option>MM</option>
								<option>01 - Janiary</option>
								<option>02 - February</option>
								<option>03 - February</option>
							</select>
							<span style="width:20px; text-align: center"> / </span>
							<select class="form-control" style="width:100px">
								<option>YY</option>
								<option>2018</option>
								<option>2019</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label data-toggle="tooltip" title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
						<input class="form-control" required="" type="text">
					</div> <!-- form-group.// -->
				</div>
			</div> <!-- row.// -->
			<button class="subscribe btn btn-primary btn-block" type="button"> Confirm  </button>
		</form>
      </div> <!-- card-body.// -->
    </div> <!-- card .// -->


<br><br> 

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

@stop