<!-- ========================= FOOTER ========================= -->
<footer class="section-footer bg-secondary">
	<div class="container">
		<section class="footer-top padding-y-lg text-white">
			<div class="row">
				<aside class="col-md col-6 col-sm-6 col-lg ">
					<h6 class="title">Company</h6>
					<ul class="list-unstyled">
						<li> <a href="{{route('about')}}">About us</a></li>
						<li> <a href="{{route('shop')}}">Shop</a></li>
						<li> <a href="{{route('contact')}}">Rules and terms</a></li>
						<li> <a href="{{route('about')}}">Sitemap</a></li>
					</ul>
				</aside>
				<aside class="col-md col-6 col-sm-6">
					<h6 class="title">Help</h6>
					<ul class="list-unstyled">
						<li> <a href="{{route('contact')}}">Contact us</a></li>
						<li> <a href="{{route('account.orders')}}">Order status</a></li>
						<li> <a href="">Shipping info</a></li>
					</ul>
				</aside>
				<aside class="col-md col-6 col-sm-6">
					<h6 class="title">Account</h6>
					<ul class="list-unstyled">
						<li> <a href="{{route('login')}}"> User Login </a></li>
						<li> <a href="{{route('register')}}"> User register </a></li>
						<li> <a href="{{route('account.settings')}}"> Account Setting </a></li>
						<li> <a href="{{route('account.orders')}}"> My Orders </a></li>
					</ul>
				</aside>
				<aside class="col-md col-6 col-sm-6">
					<h6 class="title">Social</h6>
					<ul class="list-unstyled">
						<li><a href="{{ config('settings.social_facebook') }}"> <i class="fab fa-facebook"></i> Facebook </a></li>
						<li><a href="{{ config('settings.social_twitter') }}"> <i class="fab fa-twitter"></i> Twitter </a></li>
						<li><a href="{{ config('settings.social_instagram') }}"> <i class="fab fa-instagram"></i> Instagram </a></li>
						<li><a href="{{ config('settings.social_youtube') }}"> <i class="fab fa-youtube"></i> Youtube </a></li>
					</ul>
				</aside>
			</div> <!-- row.// -->
		</section>	<!-- footer-top.// -->

		<section class="footer-bottom text-center">
		
				<p class="text-white">{{ config('settings.footer_copyright_text') }}</p>
				<p class="text-muted"> &copy 2021 Nyati Supreme, All rights reserved </p>
				<br>
		</section>
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->