<header class="section-header">
<section class="navbar-light border-bottom">
<div class="container">
  <nav class="d-flex align-items-center flex-column flex-md-row">
    <ul class="nav mr-md-auto">
    		<li class="nav-item dropdown" data-toggle="tooltip" data-placement="top" title="Contact us email">
    			<a href="{{route('contact')}}" class="nav-link pl-0"> info@nyatisupreme.co.ke </a>
    		</li>
    		 <li class="nav-item dropdown" data-toggle="tooltip" data-placement="top" title="">
    		 	    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i> My Account  </a>
    		        <ul class="dropdown-menu small">
                        @guest
                            <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @if (Route::has('register'))
                            <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @endif

                        @else
                            <li><a class="dropdown-item" href="{{ route('account.dashboard') }}">Account</a></li>
                            <li><a class="dropdown-item" href="{{ route('account.orders') }}">Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a></li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                        @endguest
    		        </ul>

    		</li>
    </ul>
 
    <ul class="nav ">
        @auth
            <li class="icon" style="position:relative;top:3px;right:20px"><img class="icon icon-xs rounded-circle" src="{{ asset('storage/' . Auth::user()->profile_image) }}"></li>
        @endauth
        <!-- <li  class="nav-item"><a href="#" class="nav-link">  <i class="fa fa-heart"></i> Wishlist </a></li> -->
        <li  class="nav-item" data-toggle="tooltip" data-placement="top" title="Cart"><a href="#" class="nav-link"> <i class="fa fa-shopping-cart"></i> My Cart <span class="badge badge-pill badge-danger">{{$cartCount}}</span> </a></li>
    </ul>
  </nav> <!-- nav .// --> 
</div> <!-- container //  -->
</section> <!-- header-top .// -->

<section class="border-bottom">
<nav class="navbar navbar-main  navbar-expand-lg navbar-light">
  <div class="container">
  	<a class="navbar-brand" href="{{route('home')}}"><img src="{{ asset('frontend/cssfiles/images/nyati_logo_png.png') }}" class="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav2" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main_nav2">
      <ul class="navbar-nav mr-auto">
	  <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Home">
			<a class="nav-link" href="{{route('home')}}">Home</a>
		</li>
		<li class="nav-item" data-toggle="tooltip" data-placement="top" title="Shop">
		<a class="nav-link" href="{{route('shop')}}">shop</a>
		</li>
		<li class="nav-item" data-toggle="tooltip" data-placement="top" title="About Us">
		<a class="nav-link" href="{{route('about')}}">About</a>
		</li>
		<li class="nav-item" data-toggle="tooltip" data-placement="top" title="Contact Us">
		<a class="nav-link" href="{{route('contact')}}">Contact Us</a>
		</li>

      </ul>

      <form class="form-inline my-2 my-lg-0" data-toggle="tooltip" data-placement="top" title="search item">
		    <div class="input-group">
          <input type="text" class="form-control" placeholder="Search an item">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
		  </form>

    </div> <!-- collapse .// -->
  </div> <!-- container .// -->
</nav>
</section> <!-- header-main .// -->
</header> <!-- section-header.// -->