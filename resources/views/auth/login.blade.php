@extends('frontend.authapp')

@section('content')
<section class="section-content padding-y bg">
<div class="container">

<div class="row justify-content-center">
	<aside class="col-md-6 col-lg-6">

<!-- ============================ COMPONENT LOGIN 1  ================================= -->
	<div class="card mb-4">
      <div class="card-body">
      <h4 class="card-title mb-4">{{ __('Login') }}</h4>
       
       <!-- <a href="{{ route('login.request.facebook') }}" class="btn btn-facebook btn-block mb-4"> <i class="fab fa-facebook-f"></i> &nbsp  Sign in with Facebook</a>
       <a href="{{ route('login.request.google') }}" class="btn btn-google btn-block mb-4"> <i class="fab fa-google"></i> &nbsp  Sign in with Google</a> -->

      <form method="POST" action="{{ route('login') }}">
        @csrf

          <div class="form-group">
             <label>Email</label>
             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
          </div> <!-- form-group// -->

          <div class="form-group">
            <label>Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                @if (Route::has('password.request'))
                        <a class="float-right" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                    @endif
          </div> <!-- form-group// -->

          <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="exampleCheck1">{{ __('Remember Me') }}</label>
            </div> <br>

          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block"> {{ __('Login') }}  </button>
          </div> <!-- form-group// -->    

          <p class="text-center">Dont have an account? <a href="{{route('register')}}">Sign Up</a></p>


      </form>
      </div> <!-- card-body.// -->
    </div> <!-- card .// -->
<!-- ============================ COMPONENT LOGIN 1  END.// ================================= -->

	</aside>
</div> <!-- row.// -->




</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
