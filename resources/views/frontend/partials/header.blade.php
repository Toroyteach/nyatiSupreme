<header class="section-header">
<section class="header-main border-bottom">
	<div class="container">
<div class="row align-items-center">
	<div class="col-lg-3 col-sm-4 col-md-4 col-5">
	<a href="http://bootstrap-ecommerce.com" class="brand-wrap">
		<img class="logo" src="{{ asset('frontend/cssfiles/images/logo.png') }}">
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
					<div class="icon"><i class="text-primary fa fa-lg fa-heart"></i></div>
					<div class="text">
						<small class="text-muted">Favorites</small> 
						<div>0 item</div>
					</div>
				</a>
			</div> <!-- widget .// -->
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
					<div class="icon"><i class="text-primary fa fa-lg fa-user"></i></div>
					<div class="text"> 
						<small class="text-muted">Hello.</small> 

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
