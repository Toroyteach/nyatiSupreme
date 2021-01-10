@extends('frontend.app')
@section('content')
    <!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
<div class="container">
	<h2 class="title-page">Edit Address</h2>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION PAGETOP END// ========================= -->


<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
	<div class="container">
	
	<div class="row">
		<aside class="col-md-3">
        @include('frontend.pages.account.nav.nav')
		</aside> <!-- col.// -->
		<main class="col-md-9">

<!-- ============================ COMPONENT PROFILE  ================================= -->
<div class="card mb-4">
      <div class="card-body">
     <form action="{{ route('account.address.update', ['id' => $address->id]) }}" method="POST" role="form">
         @csrf
        <div class="form-row">
			<div class="col form-group">
				<label>Name</label>
			  	<input type="text" class="form-control" name="fullname" value="{{$address->fullname}}" disabled>
			</div> <!-- form-group end.// -->
			<div class="col form-group">
				<label>Email</label>
			  	<input type="email" class="form-control" name="email" value="{{$address->user->email}}" disabled>
			</div> <!-- form-group end.// -->
		</div> <!-- form-row.// -->
		
		<div class="form-row">
			<div class="form-group col-md-6">
			  <label>County</label>
              <input type="text" class="form-control @error('county') is-invalid @enderror" name="county" value="{{$address->county}}" required>
			</div> <!-- form-group end.// -->
			<div class="form-group col-md-6">
			  <label>City</label>
			  <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{$address->city}}" required>
			</div> <!-- form-group end.// -->
		</div> <!-- form-row.// -->

		<div class="form-row">
			<div class="form-group col-md-6">
			  <label>Town</label>
			  <input type="text" class="form-control @error('town') is-invalid @enderror" name="town" value="{{$address->town}}" required>
			</div> <!-- form-group end.// -->
			<div class="form-group col-md-6">
			  <label>Location</label>
			  <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{$address->location}}" required>
			</div> <!-- form-group end.// -->
		</div> <!-- form-row.// -->

		<button class="btn btn-primary btn-block" type="submit">Update</button>
      </form>
      </div> <!-- card-body.// -->
    </div> <!-- card .// -->
<!-- ============================ COMPONENT PROFILE END.// ================================= -->

	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@stop
