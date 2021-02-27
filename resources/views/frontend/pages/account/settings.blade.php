@extends('frontend.app')
@section('content')
    <!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
<div class="container">
	<h2 class="title-page">My account</h2>
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

	@if (session('message'))
            <div class="col-sm-12">
                <div class="alert  alert-warning alert-dismissible fade show" role="alert">
                {{session('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        @endif

	<div class="card">
      <div class="card-body">
	 <form class="row" action="{{ route('account.users.update') }}" method="POST" role="form" enctype="multipart/form-data">
	 @csrf
     	<div class="col-md-9">
     		<div class="form-row">
				<div class="col form-group">
					<label>First Name</label>
				  	<input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{$userDetails->first_name}}" required>
				</div> <!-- form-group end.// -->
				<div class="col form-group">
					<label>Last Name</label>
				  	<input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" value="{{$userDetails->last_name}}" required>
				</div> <!-- form-group end.// -->
			</div> <!-- form-row.// -->

			<div class="form-row">
				<div class="col form-group">
					<label>Email</label>
				  	<input type="email" name="email" class="form-control" value="{{$userDetails->email}}" disabled>
				</div> <!-- form-group end.// -->
			</div> <!-- form-row.// -->
			
			<div class="form-row">
				<div class="form-group col-md-6">
				  <label>Country</label>
				  <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" id="country" value="{{$userDetails->country}}" required>
				</div> <!-- form-group end.// -->
				<div class="form-group col-md-6">
				  <label>City</label>
				  <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" id="city" value="{{$userDetails->city}}" required>
				</div> <!-- form-group end.// -->
			</div> <!-- form-row.// -->

			<div class="form-row">
				<div class="form-group col-md-6">
				  <label>Address</label>
				  <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" value="{{$userDetails->address}}" required>
				</div> <!-- form-group end.// -->
				<div class="form-group col-md-6">
				  <label>Phone</label>
				  <input type="number" name="phonenumber" class="form-control @error('phonenumber') is-invalid @enderror" id="phonenumber" value="{{$userDetails->phonenumber}}" required>
				</div> <!-- form-group end.// -->
			</div> <!-- form-row.// -->

			<div class="form-row">
				<div class="form-group col-md-6">
				  <label>Choose Image</label>
				  <input type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image" id="avatar">
				</div> <!-- form-group end.// -->
			</div> <!-- form-row.// -->

			<button class="btn btn-primary" type="submit">Save</button>		
			<a href="{{ route('update.password') }}" class="btn btn-light btn-lg active" role="button" aria-pressed="true">Change Password</a>

			<br><br><br><br><br><br>

     	</div> <!-- col.// -->
     	<div class="col-md">

		 @if ($userDetails->profile_image != null)
		 @if($userDetails->social != 1)
									<img src="{{ asset('storage/'. Auth::user()->profile_image) }}" class="rounded-circle img-sm border" alt="img">
									@else
									<img src="{{ (Auth::user()->profile_image) }}" class="rounded-circle img-sm border" alt="img">
									@endif			@else
			<img src="{{ asset('frontend/cssfiles/images/avatars/avatarimg.png') }}" class="img-md rounded-circle border">
		@endif

     	</div>  <!-- col.// -->
      </form>
	  <a class="btn btn-primary" href="{{route('account.users.delete', Auth::user()->id)}}" role="button">Delete Account</a>		

      </div> <!-- card-body.// -->
    </div> <!-- card .// -->



	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@stop
