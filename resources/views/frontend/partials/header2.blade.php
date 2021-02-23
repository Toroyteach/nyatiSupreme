<header class="section-header">
<section class="navbar-light border-bottom">
<div class="container" style="color:blue;">
  <nav class="d-flex align-items-center flex-column flex-md-row navbar-light">
    <ul class="nav mr-md-auto">
    		<li class="nav-item dropdown" data-toggle="tooltip" data-placement="top" title="Contact us email">
    			<a href="{{route('contact')}}" class="nav-link pl-0">info@nyatisupreme.co.ke</a>
    		</li>
    		 <li class="nav-item dropdown" data-toggle="tooltip" data-placement="top" title="">
    		 	    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle"></i> Account</a>
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
            @if (Auth::user()->profile_image != null)
              @if(Auth::user()->social != 1)
                <li class="icon" style="position:relative;right:20px;top:-5px;"><a href="{{ route('account.settings') }}"><img src="{{ asset('storage/'. Auth::user()->profile_image) }}" class="icon icon-xs rounded-circle" alt="img"></a></li>
              @else
              <li class="icon" style="position:relative;right:20px"><a href="{{ route('account.settings') }}"><img src="{{ (Auth::user()->profile_image) }}" class="icon icon-xs rounded-circle" alt="img"></a></li>
              @endif
						@else
                <li class="icon" style="position:relative;right:20px;top:3px;"><a href="{{ route('account.settings') }}"><img src="{{ asset('frontend/cssfiles/images/avatars/avatarimg.png') }}" class="icon icon-xs rounded-circle" alt="img"></a></li>
						@endif
        @endauth
        <!-- <li  class="nav-item"><a href="#" class="nav-link">  <i class="fa fa-heart"></i> Wishlist </a></li> -->
        <li  class="nav-item" data-toggle="tooltip" data-placement="top" title="Cart"><a href="{{ route('checkout.cart') }}" class="nav-link"> <i class="fa fa-shopping-cart"></i> My Cart <span class="badge badge-pill badge-danger">{{$cartCount}}</span> </a></li>
    </ul>
  </nav> <!-- nav .// --> 
</div> <!-- container //  -->
</section> <!-- header-top .// -->

<section class="border-bottom">
<nav class="navbar navbar-main  navbar-expand-lg navbar-light">
  <div class="container">
  	<a class="navbar-brand" href="{{route('home')}}"><img src="{{ asset('frontend/cssfiles/images/Nyati_logo_png.png') }}" class="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav2" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main_nav2">
      <ul class="navbar-nav mr-auto">
	  <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Home">
			<a class="nav-link" href="{{route('home')}}">Home</a>
		</li>
    <li class="nav-item" data-toggle="tooltip" data-placement="top" title="About Us">
		<a class="nav-link" href="{{route('category.show')}}">Categories</a>
		</li>
		<li class="nav-item" data-toggle="tooltip" data-placement="top" title="Shop">
		<a class="nav-link" href="{{route('shop')}}">Shop</a>
		</li>
		<li class="nav-item" data-toggle="tooltip" data-placement="top" title="About Us">
		<a class="nav-link" href="{{route('about')}}">About</a>
		</li>
		<li class="nav-item" data-toggle="tooltip" data-placement="top" title="Contact Us">
		<a class="nav-link" href="{{route('contact')}}">Contact Us</a>
		</li>

      </ul>

      <form class="form-inline my-2 my-lg-0" data-toggle="tooltip" data-placement="top" title="search item" action="{{ route('product.search') }}" method="post" autocomplete="off"> 
      @csrf
		    <div class="input-group">
          <input type="text" class="form-control" id="search" placeholder="Search an item" name="item">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
          </div>
        </div>
		  </form>

    </div> <!-- collapse .// -->
  </div> <!-- container .// -->
</nav>
</section> <!-- header-main .// -->
</header> <!-- section-header.// -->

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var route = "{{ url('autocomplete') }}";
    $('#search').typeahead({
        source:  function (term, process) {
        return $.get(route, { term: term }, function (data) {
                return process(data);
            });
        }
    });
</script>
@endpush