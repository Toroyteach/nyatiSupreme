<header class="section-header">
<section class="header-main border-bottom">
	<div class="container">
<div class="row align-items-center">
	<div class="col-lg-3 col-sm-4 col-md-4 col-5" id="logo">
	<a href="https://nyatisupreme.co.ke" class="brand-wrap">
		<img class="logo" style="" src="{{ asset('frontend/cssfiles/images/nyati_logo_png.png') }}">
	</a> <!-- brand-wrap.// -->
	</div>
	<div class="col-lg-4 col-xl-5 col-sm-8 col-md-4 d-none d-md-block">
			<form action="#" class="search-wrap">
				<div class="input-group w-100">
				    <input type="text" class="form-control" style="width:55%;" placeholder="Search">
				    <div class="input-group-append">
				      <button class="btn btn-primary" type="submit">
				        <i class="fa fa-search"></i>
				      </button>
				    </div>
			    </div>
			</form> <!-- search-wrap .end// -->
	</div> <!-- col.// -->
	<div class="col-lg-5 col-xl-4 col-sm-8 col-md-4 col-7">
		<div class="widgets-wrap d-flex justify-content-end">
			<div class="widget-header">
				<a href="#" class="ml-4 icontext">
					<div class="icon"><i class="text-primary fa fa-lg fa-shopping-cart"></i></div>
					<div class="text">
						<small class="text-muted">Cart</small> 
						<div>3 items</div>
					</div>
				</a>
			</div> <!-- widget .// -->
			<div class="widget-header dropdown">
				<a href="#" class="ml-4 icontext" data-toggle="dropdown" data-offset="20,10">

				@auth
					<div class="icon"><img class="icon icon-xs rounded-circle" src="{{ asset('storage/' . Auth::user()->profile_image) }}"></div>
				@endauth

					<div class="text"> 
						<small class="text-muted">Hello. </small> 

						<div>Account<i class="fa fa-caret-down"></i></div>

					</div>
				</a>
				<div class="dropdown-menu dropdown-menu-right">

				@guest
                                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
								
									<a class="dropdown-item" href="{{ route('account.dashboard') }}">Account</a>
									<a class="dropdown-item" href="{{ route('account.orders') }}">Orders</a>
									<hr class="dropdown-divider">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                        @endguest

				</div> <!--  dropdown-menu .// -->
			</div> <!-- widget  dropdown.// -->
		</div>	<!-- widgets-wrap.// -->
	</div> <!-- col.// -->
</div> <!-- row.// -->
	</div> <!-- container.// -->
</section> <!-- header-main .// -->
@include('frontend.partials.nav')
</header> <!-- section-header.// -->


<header class="section-header">
<section class="navbar-light border-bottom">
<div class="container">
  <nav class="d-flex align-items-center flex-column flex-md-row">
    <ul class="nav mr-md-auto">
    		<li class="nav-item dropdown">
    			<a href="#" class="nav-link pl-0 dropdown-toggle"> info@nyatisupreme.com </a>
    		</li>
    		 <li class="nav-item dropdown">
    		 	<a href="#" class="nav-link dropdown-toggle">   +25412398603 </a>
    		</li>
    </ul>
 
    <ul class="nav ">
        <li class="nav-item"><a href="#" class="nav-link">  <i class="fa fa-user-circle"></i> My Account </a></li>
        <li  class="nav-item"><a href="#" class="nav-link">  <i class="fa fa-heart"></i> Wishlist </a></li>
        <li  class="nav-item"><a href="#" class="nav-link"> <i class="fa fa-shopping-cart"></i> My Cart <span class="badge badge-pill badge-danger">1</span> </a></li>
    </ul>
  </nav> <!-- nav .// --> 
</div> <!-- container //  -->
</section> <!-- header-top .// -->

<section class="border-bottom">
<nav class="navbar navbar-main  navbar-expand-lg navbar-light">
  <div class="container">
  	<a class="navbar-brand" href="https://nyatisupreme.co.ke"><img src="{{ config('settings.site_logo') }}" class="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav2" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main_nav2">
      <ul class="navbar-nav mr-auto">
	  <li class="nav-item">
			<a class="nav-link" href="#">Home</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="#">shop</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="#">About</a>
		</li>
		<li class="nav-item">
		<a class="nav-link" href="#">Contact Us</a>
		</li>
      </ul>

      <form class="form-inline my-2 my-lg-0">
		    <div class="input-group">
          <input type="text" class="form-control" placeholder="Search">
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