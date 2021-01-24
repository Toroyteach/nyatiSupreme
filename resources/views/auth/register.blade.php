@extends('frontend.authapp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <!-- ============================ COMPONENT REGISTER ================================= -->
            <div class="card mb-4">
                <article class="card-body">
                    <header class="mb-4">
                        <h4 class="card-title">Sign up</h4>
                    </header>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col form-group">
                                <label>First name</label>
                                <input id="firstname" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div> <!-- form-group end.// -->
                            <div class="col form-group">
                                <label>Last name</label>
                                <input id="lastname" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row end.// -->
                        <div class="form-group">
                            <label>Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div> <!-- form-group end.// -->
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Create password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div> <!-- form-group end.// --> 
                            <div class="form-group col-md-6">
                                <label>Repeat password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div> <!-- form-group end.// -->  
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Phone Number</label>
                                <input id="phonenumber" type="number" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') }}" required autocomplete="phonenumber">
                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div> <!-- form-group end.// --> 
                            <div class="form-group col-md-6">
                                <label> Address</label>
                                <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div> <!-- form-group end.// -->  
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Town</label>
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">
                                @error('city')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div> <!-- form-group end.// --> 
                            <div class="form-group col-md-6">
                                <label>Country</label>
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country">
                                @error('country')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div> <!-- form-group end.// -->  
                        </div>

                        <div class="form-group"> 
                            <label class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input @error('termsCheckbox') is-invalid @enderror" name="termsCheckbox"> <div class="custom-control-label"> I agree with <a href="#">terms and contitions</a>  </div> </label>
                                @error('termsCheckbox')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                        </div> <!-- form-group end.// --> 

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> {{ __('Register') }}  </button>
                        </div> <!-- form-group// -->      
                                                            
                    </form>
                    <hr>
                    <p class="text-center">Have an account? <a href="{{route('login')}}">Log In</a></p>
                </article> <!-- card-body end .// -->
            </div> <!-- card.// -->
        <!-- ============================ COMPONENT REGISTER END .// ================================= -->
        </div>
    </div>
</div>
@endsection
