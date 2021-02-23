
<!-- ========================= FOOTER ========================= -->
<footer class="section-footer bg-secondary text-white">
	<div class="container">
		<section class="footer-top  padding-y-lg">
			<div class="row">
				<aside class="col-md-4 col-12">
					<article class="mr-md-4">
						<h5 class="title">Contact us</h5>
						<p>Feel free to contact us anytime with your inquiries.</p>
						<ul class="list-icon">
							<li> <i class="icon fa fa-map-marker"> </i>Kisumu road; directly opposite Catholic University. </li>
							<li> <i class="icon fa fa-envelope"> </i> info@nyatisupreme.co.ke</li>
							<li> <i class="icon fa fa-phone"> </i> 0722 550 247</li>
							<li> <i class="icon fa fa-clock"> </i>Mon-Sat 9:00am - 6:00pm</li>
						</ul>
					</article>
				</aside>
				<aside class="col-md col-6">
					<h5 class="title">Information</h5>
					<ul class="list-unstyled">
						<li> <a href="{{route('about')}}">About us</a></li>
						<li> <a href="{{route('shop')}}">Shop</a></li>
						<li> <a href="{{route('contact')}}">Contact us</a></li>
						<li> <a href="{{route('account.orders')}}">Order status</a></li>
						<li> <a href="{{route('checkout.cart')}}">Shipping info</a></li>
					</ul>
				</aside>
				<aside class="col-md col-6">
					<h5 class="title">My Account</h5>
					<ul class="list-unstyled">
						<li> <a href="{{route('login')}}"> User Login </a></li>
						<li> <a href="{{route('register')}}"> User register </a></li>
						<li> <a href="{{route('account.settings')}}"> Account Setting </a></li>
						<li> <a href="{{route('account.orders')}}"> My Orders </a></li>
					</ul>
				</aside>
				<aside class="col-md-4 col-12">
					<h5 class="title">Newsletter</h5>
					<p>Through our “client is king” philosophy we have ensured to train our staff on customer care and interaction </p>
					
					<form class="form-inline mb-3" action="{{ route('subscribers.store') }}" method="post">
					@csrf
						<input type="text" placeholder="Your Email" type="email" name="email" class="border-0 w-auto form-control">
						<button class="btn ml-2 btn-warning" type="submit"> Subscribe</button>
					</form>

					<p class="text-white-50 mb-2">Follow us on social media</p>
					<div>
						<a href="{{ config('settings.social_facebook') }}" class="btn btn-icon btn-outline-light"><i class="fab fa-facebook-f"></i></a>
						<a href="{{ config('settings.social_twitter') }}" class="btn btn-icon btn-outline-light"><i class="fab fa-twitter"></i></a>
						<a href="{{ config('settings.social_instagram') }}" class="btn btn-icon btn-outline-light"><i class="fab fa-instagram"></i></a>
						<a href="{{ config('settings.social_youtube') }}" class="btn btn-icon btn-outline-light"><i class="fab fa-youtube"></i></a>
					</div>

				</aside>
			</div> <!-- row.// -->
		</section>	<!-- footer-top.// -->

		<section class="footer-bottom text-center">
				<a href="{{route('privacypolicy')}}"><p class="text-white">{{ config('settings.footer_copyright_text', 'Privacy Policy') }}</p></a>
				<p class="text-muted"> &copy 2021 Nyati Supreme, All rights reserved </p>
				<br>
		</section>
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->