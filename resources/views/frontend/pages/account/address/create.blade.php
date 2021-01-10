@extends('frontend.app')
@section('content')
    <!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
<div class="container">
	<h2 class="title-page">Create Delivery Address</h2>
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

        @if (isset($success))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                $success
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        @endif

<!-- ============================ COMPONENT PROFILE  ================================= -->
<div class="card mb-4">
      <div class="card-body">
     <form action="{{ route('account.address.store') }}" method="POST" role="form" >
         @csrf
        <div class="form-row">
			<div class="col form-group">
				<label>Name</label>
			  	<input type="text" class="form-control" value="John" disabled>
			</div> <!-- form-group end.// -->
			<div class="col form-group">
				<label>Email</label>
			  	<input type="email" class="form-control" value="Michael" disabled>
			</div> <!-- form-group end.// -->
		</div> <!-- form-row.// -->
		
		<div class="form-row">
			<div class="form-group col-md-6">
			  <label>County</label>
              <input type="text" class="form-control @error('county')" placeholder="enter county" name="county" required>
			</div> <!-- form-group end.// -->
			<div class="form-group col-md-6">
			  <label>City</label>
			  <input type="text" class="form-control @error('city')" placeholder="enter city" name="city" required>
			</div> <!-- form-group end.// -->
		</div> <!-- form-row.// -->

		<div class="form-row">
			<div class="form-group col-md-6">
			  <label>Town</label>
			  <input type="text" class="form-control @error('town')" placeholder="enter town" name="town" required>
			</div> <!-- form-group end.// -->
			<div class="form-group col-md-6">
			  <label>Location</label>
			  <input type="text" class="form-control @error('location')" placeholder="enter suitable area name" name="location" required>
			</div> <!-- form-group end.// -->
		</div> <!-- form-row.// -->

		<button class="btn btn-primary btn-block" type="submit">Save</button>
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
