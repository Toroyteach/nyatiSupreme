@extends('frontend.app')
@section('content')
<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page">Contact us</h2>
	<nav>
	<ol class="breadcrumb text-white">
	    <li class="breadcrumb-item"><a href="#">Home</a></li>
	    <li class="breadcrumb-item"><a href="#">Contact us</a></li>
	</ol>  
	</nav>
</div> <!-- container //  -->

<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 100%;">
                <div style="width: 100%;">   
                    <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=0.4843099855639862,%2035.265163779258735+(Nyati%20Supreme%20Concrete%20works)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
		<!-- contact-middle-area-start -->
		<div class="contact-middle-area pt-100 pb-70">
			<div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- ============================ COMPONENT ITEM BG ================================= -->
                    <div class="shadow-sm card-banner">
                    <div class="p-4" style="width:75%">
                    <address>
                                    <strong>Example Inc.</strong><br>
                                    1234 Example Street<br>
                                    Antartica, Example 0987<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                    </div> 
                    <img src="../images/banners/banner-item1.jpg" height="150" class="img-bg">
                    </div>
                    <!-- ============================ COMPONENT ITEM BG  END .// =========================== -->
                </div> <!-- col.// -->
                <div class="col-md-4">
                    <!-- ============================ COMPONENT ITEM BG ================================= -->
                    <div class="shadow-sm card-banner">
                    <div class="p-4" style="width:70%">
                    <address>
                                    <strong>Example Inc.</strong><br>
                                    1234 Example Street<br>
                                    Antartica, Example 0987<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                    </div>
                    <img src="../images/banners/banner-item2.jpg" height="150" class="img-bg">
                    </div>
                    <!-- ============================ COMPONENT ITEM BG  END .// =========================== -->
                </div> <!-- col.// -->
                <div class="col-md-4">
                    <!-- ============================ COMPONENT ITEM BG ================================= -->
                    <div class="shadow-sm card-banner">
                    <div class="p-4" style="width:75%">
                        <address>
                                    <strong>Example Inc.</strong><br>
                                    1234 Example Street<br>
                                    Antartica, Example 0987<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                    </div>
                    <img src="../images/banners/banner-item3.jpg" height="150" class="img-bg">
                    </div>
                    <!-- ============================ COMPONENT ITEM BG  END .// =========================== -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
			</div>
		</div>
		<!-- contact-middle-area-end -->
<br><br>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6 col-md-offset-3 col-sm-12">
			<div class="contact-bottom-text text-center">
				<h2>Let’s talk</h2>
				<p>The dismal man readily complied; a circle was again formed round the table, and harmony once more prevailed. Some lingering irritability appeared to find a resting-place in Mr. Winkle's bosom.</p>
			</div>
		</div>
    </div>
</div>
<br><br>
<div class="row justify-content-center">
	<aside class="col-md-6">
<!-- ============================ COMPONENT FEEDBACK  ================================= -->
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-row">
                        <div class="col form-group">
                            <label>Name</label>
                            <input type="name" class="form-control" placeholder="">
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="">
                        </div> <!-- form-group end.// -->
                    </div> <!-- form-row.// -->
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="subject" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>What is message about?</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label  for="exampleFormControlFile1">
                            <input type="file" class="form-control-file">
                        </label>
                    </div>
                    <button class="btn btn-primary btn-block">Send</button>
                </form>
            </div> <!-- card-body.// -->
        </div> <!-- card .// -->
<!-- ============================ COMPONENT FEEDBACK END.// ================================= -->
    </aside>
</div>

</section>

@stop