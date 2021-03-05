<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!-- site metas -->
<title>Sell With Us</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">	
<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/sell_with_us/css/bootstrap.min.css')}}">
<!-- style css -->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/sell_with_us/css/style.css')}}">
<!-- Responsive-->
<link rel="stylesheet" href="{{asset('frontend/sell_with_us/css/responsive.css')}}">
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="{{asset('frontend/sell_with_us/css/jquery.mCustomScrollbar.min.css')}}">
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

<link type="image/x-icon" href="{{ asset(\App\GeneralSetting::first()->favicon) }}" rel="shortcut icon" />
<style>
	  .panel-transparent {
		background: none;
		border: 1px solid white;
    }
</style>
</head>
<body>
	<header id="home"class="section">
	<div class="header_main" style="background-image:url({{asset('frontend/sell_with_us/images/banner.png')}}) ">
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                           
                            <a class="" href="{{ route('home') }}">
                            @php
                                    $generalsetting = \App\GeneralSetting::first();
                                @endphp
                                @if($generalsetting->logo != null)
                                    <img src="{{ asset($generalsetting->logo) }}" alt="{{ env('APP_NAME') }}" style="max-width: 100%;">
                                @else
                                    <img src="{{ asset('frontend/images/logo/logo.png') }}" alt="{{ env('APP_NAME') }}" style="max-width: 100%;">
                                @endif
                            </a>    
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <div class="menu-area">
                        <div class="limit-box">
                           <nav class="main-menu">
                              <ul class="menu-area-main">
                                 <li><a href="#home">Home</a></li>
                                 <li><a href="#about">About</a></li>
                                 <li><a href="#service">Service</a></li>
                                 <li><a href="#testimonial">Testimonial</a></li>
                                 <li><a href="#contact">Contact Us</a></li>
                              </ul>
                           </nav>
                        </div>
                     </div>
                 </div>
               </div>
            </div>
         </div>
         <!-- end header inner -->
      <section >
      	<div class="bannen_inner">
            <div class="container">
                <div class="row marginii">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    	<div class="taital_main">
                    		
                    	</div>
                        <h1 class="web_text"><strong>Unlimited Web Hosting</strong></h1>
                        <p class="donec_text">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. 
                           Aenean dignissim pellentesque felis.Donec nec justo
                           eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.</p>
                         <a class="get_bg" href="#" role="button">Get Started</a>
                         <a class="btn btn-lg btn-dark" href="about.html" role="button">Contact Us</a>
                    </div>
                 <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                 <div class="img-box">
                    <figure><img src="{{asset('frontend/sell_with_us/images/woofer.png')}}" alt="img"/ style="max-width: 100%;"></figure>
                 </div>
            </div>
           </div>
           <div class="emaim-bt">
           	<div class="col-md-9 margin-0">
            <div class="input-group mb-3 margin-top-20">
                <input type="text" class="form-control" placeholder="Enter domain name here">
            <div class="input-group-append">
                <button class="search_bt" type="Subscribe"><a href="#">Search</a></button>  
            </div>
            </div>           
        </div>
       </div>
     </div>
    </div>
    </section>
	</header>
    <!-- banner end -->
    <!-- choose start -->
    <div id="about" class="choose_section">
    	<div class="container">
    		<div class="col-sm-12">
    			<h1 class="choose_text">Why you should <span class="color">choose us</span></h1>
    			<p class="lorem_text">Making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover any web sites still</p>
    		</div>
    	</div>
    </div>
    <div class="choose_section_2">
    	<div class="container">
    	    <div class="row">
				@foreach ($pricingTable as  $key=>$table)
				 @if($key==0)
					<div class="col-sm-4">
						<div class="power_full">
							<div class="icon"><a href="#"><img src="{{asset('frontend/sell_with_us/images/power-full-icon.png')}}"></a></div>
							<h2 class="totaly_text text-white">{{$table->type}}/{{$table->prices}}£</h2>
							<ul class="list-group" style="margin-left: -1px;">
								<li class="list-group-item panel-transparent text-white">{{$table->time}} Days</li>
								<li class="list-group-item panel-transparent text-white">{{$table->product}} Products</li>
								@if(json_decode($table->list))
								@foreach(json_decode($table->list) as $li)
								<li class="list-group-item panel-transparent text-white">{{$li}}}}</li>
								@endforeach
								@endif
							</ul>   
						</div>
						<div class="btn_main">
							<button type="button" role="button"  class="read_bt"><a href="{{route('shops.create')}}">Choose Plan</a></button>
						</div>
					</div>
				@else
					<div class="col-sm-4">
						<div class="power">
							<div class="icon"><a href="#"><img src="{{asset('frontend/sell_with_us/images/optimised-icon.png')}}"></a></div>
							<h2 class="totaly_text">{{$table->type}}/{{$table->prices}}£</h2>
							<ul class="list-group" style="margin-left: -1px;">
								<li class="list-group-item">{{$table->time}} Days</li>
								<li class="list-group-item">{{$table->product}} Products</li>
								@if(json_decode($table->list))
								@forelse(json_decode($table->list) as $li)
								<li class="list-group-item">{{$li}}}}</li>
								@endforeach
								@endif
							</ul>    
						</div>
						
						<div class="btn_main">
							<button type="button" role="button"  class="read_bt"><a href="{{route('shops.create')}}">Choose Plan</a></button>
						</div>
					</div>
				@endif
				@endforeach
    	    </div>    		
    	</div>
    </div>
    <!-- choose start -->
    <!-- about start -->
    <div class="about_main layout_padding">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6">
    				<div class="images">
    					<img src="{{asset('frontend/sell_with_us/images/img-1.png')}}" style="max-width: 100%;">
    				</div>
    			</div>
    			<div class="col-md-6">
    				<div class="right_section_main">
    					<h1 class="dolar_tetx"><strong style="color: #2ba879;">599.00* .com</strong></h1>
    					<h2 class="special_text">Special Offer For Limited Time. 30% Discount On All Hosting Plans</h2>
    					<p class="donec_text">making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still </p>
    					<div class="right_aero"><img src="{{asset('frontend/sell_with_us/images/right-aerow.png')}}"></div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- about end -->
    <!-- service start -->
    <div id="service" class="choose_section">
    	<div class="container">
    		<div class="col-sm-12">
    			<h1 class="choose_text">Our<span class="color"> Service</span></h1>
    			<p class="lorem_text">Lorem ipsum dolor sittem ametamngcing elit, per sed do eiusmoad 
teimpor sittem elit inuning ut sed.</p>
    		</div>
    	</div>
    </div>
    <div class="choose_section_2">
    	<div class="container">
    	    <div class="row">
    		    <div class="col-sm-4">
    			    <div class="about_inner">
    				    <div class="icon"><a href="#"><img src="{{asset('frontend/sell_with_us/images/icon-1.png')}}"></a></div>
    				    <h2 class="totaly_text">Shared Hosting</h2>
    				    <p class="making">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.</p>
    			    </div>
    		    </div>
    		    <div class="col-sm-4">
    			    <div class="dedicated">
    				    <div class="icon"><a href="#"><img src="{{asset('frontend/sell_with_us/images/icon-2.png')}}"></a></div>
    				    <h2 class="hosting_text">Dedicated Hosting</h2>
    				    <p class="justo_text">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.</p>
    			    </div>
    		    </div>
    		    <div class="col-sm-4">
    			    <div class="about_inner">
    				    <div class="icon"><a href="#"><img src="{{asset('frontend/sell_with_us/images/icon-3.png')}}"></a></div>
    				    <h2 class="totaly_text">Domain Registration</h2>
    				    <p class="making">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.</p>
    			    </div>
    		    </div>
    	    </div>    		
    	</div>
    </div>

    <div class="choose_section_2">
    	<div class="container">
    	    <div class="row">
    		    <div class="col-sm-4">
    			    <div class="about_inner">
							<div class="icon"><a href="#"><img src="{{asset('frontend/sell_with_us/images/icon-4.png')}}"></a></div>
    				    <h2 class="totaly_text">Shared Hosting</h2>
    				    <p class="making">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.</p>
    			    </div>
    		    </div>
    		    <div class="col-sm-4">
    			    <div class="about_inner">
    				    <div class="icon"><a href="#"><img src="{{asset('frontend/sell_with_us/images/icon-5.png')}}"></a></div>
    				    <h2 class="totaly_text">Dedicated Hosting</h2>
    				    <p class="making">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.</p>
    			    </div>
    		    </div>
    		    <div class="col-sm-4">
    			    <div class="about_inner">
    				    <div class="icon"><a href="#"><img src="{{asset('frontend/sell_with_us/images/icon-6.png')}}"></a></div>
    				    <h2 class="totaly_text">Domain Registration</h2>
    				    <p class="making">Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.</p>
    			    </div>
    		    </div>
    	    </div>
    	    <div class="bt_main">
    	    	<button class="read_more"><a href="#">Read More</a></button>
            </div>   		
    	</div>
    </div>

    <!-- service end -->
    <!-- contact start -->
    <div id="contact" class="contact_section">
    	<div class="container">
    		<div class="col-sm-12">
    			<h1 class="choose_text">Request A Call  Back</h1>
    			<p class="lorem_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
    		</div>
    	</div>
    </div>
    <div class="contact_section_2">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6">
    				<div class="input_main">
                       <div class="container">
                          <form action="/action_page.php">
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="Name" name="Name">
                            </div>
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="Email" name="Email">
                            </div>
                            <div class="form-group">
                              <input type="text" class="email-bt" placeholder="Phone" name="Email">
                            </div>
                                <div class="form-group">
                                  <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="text"></textarea>
                                </div>
                            </form>
                          
                       </div> 
                       <div class="send_btn">
                        <button type="button" class="main_bt"><a href="#">Send</a></button>
                       </div>                   
                    </div>
    			</div>
    			<div class="col-md-6">
    				<div class="section_right">
    					<img src="{{asset('frontend/sell_with_us/images/img-2.png')}}" style="max-width: 100%;">
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="contact_section_3">
    	<div class="container">
    		<div class="contact_taital">
    			<div class="row web">
    				<div class="col-sm-12 col-md-12 col-lg-4">
    					<div class="map_main">
    						<img src="{{asset('frontend/sell_with_us/images/map-icon.png')}}">
    						<span class="londan_text">London 145 United Kingdom</span>
    					</div>
    				</div>
    				<div class="col-sm-6 col-md-6 col-lg-4">
    					<div class="map_main">
    						<img src="{{asset('frontend/sell_with_us/images/phone-icon.png')}}">
    						<span class="londan_text">+7586656566</span>
    					</div>
    				</div>
    				<div class="col-sm-6 col-md-6 col-lg-4">
    					<div class="map_main">
    						<img src="{{asset('frontend/sell_with_us/images/email-icon.png')}}">
    						<span class="londan_text">demo@gmail.com</span>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="contact_product">
    			<div class="row">
    				<div class="col-sm-6 col-md-6 col-lg-2">
    					<div class="footer-logo"><img src="{{asset('frontend/sell_with_us/images/footer-logo.png')}}" style="max-width: 100%;"></div>
    				</div>
    				<div class="col-sm-6 col-md-6 col-lg-4">
    					<h1 class="useful_text">USEFUL LINK</h1>
    				<div class="menu">
    					<ul>
    						<li><a href="#home"><img src="{{asset('frontend/sell_with_us/images/bulit-icon.png')}}" style="padding-right: 10px;">Home</a></li>
    						<li><a href="#about"><img src="{{asset('frontend/sell_with_us/images/bulit-icon.png')}}" style="padding-right: 10px;">About</a></li>
    						<li><a href="#service"><img src="{{asset('frontend/sell_with_us/images/bulit-icon.png')}}" style="padding-right: 10px;">Services</a></li>
    						<li><a href="#contact"><img src="{{asset('frontend/sell_with_us/images/bulit-icon.png')}}" style="padding-right: 10px;">Contact Us</a></li>
    					</ul>
    				</div>	
    				</div>
    				<div class="col-sm-12 col-md-12 col-lg-6">
    					<h1 class="useful_text">PRODUCT</h1>
    					<div class="menu multi_column_menu">
    					   <ul>
    						  <li class="footer_menu"><a href="#"><img src="{{asset('frontend/sell_with_us/images/bulit-icon.png')}}" class="footer_menu">Webhosting</a></li>
    						  <li class="footer_menu"><a href="#"><img src="{{asset('frontend/sell_with_us/images/bulit-icon.png')}}" class="footer_menu">Reseler Hosting</a></li>
    						  <li class="footer_menu"><a href="#"><img src="{{asset('frontend/sell_with_us/images/bulit-icon.png')}}" class="footer_menu">VPS Hosting</a></li>
    						  <li class="footer_menu"><a href="#"><img src="{{asset('frontend/sell_with_us/images/bulit-icon.png')}}" class="footer_menu">Wordpress Hosting</a></li>
    						  <li class="footer_menu"><a href="#"><img src="{{asset('frontend/sell_with_us/images/bulit-icon.png')}}" class="footer_menu">Dedicated hosting</a></li>
    						  <li class="footer_menu"><a href="#"><img src="{{asset('frontend/sell_with_us/images/bulit-icon.png')}}" class="footer_menu">Windows</a></li>
    					   </ul>
    				    </div>
    				    <div class="input-group mb-3 margin-top-30">
                           <input type="text" class="form-control" placeholder="Enter you email">
                           <div class="input-group-append">
                              <button class="subsrcibe_bt" type="Subscribe"><a href="#">SUBSCRIBE</a></button>  
                           </div>
                        </div>
    				</div>
    			</div>
    		</div>
    		<div class="icon_main">
    			<div class="row">
    				<div class="col-sm-12">
    					<div class="menu_text">
    						<ul>
    						   <li><a href="#"><img src="{{asset('frontend/sell_with_us/images/fb-icon.png')}}"></a></li>
    						   <li><a href="#"><img src="{{asset('frontend/sell_with_us/images/twitter-icon.png')}}"></a></li>
    						   <li><a href="#"><img src="{{asset('frontend/sell_with_us/images/in-icon.png')}}"></a></li>
    						   <li><a href="#"><img src="{{asset('frontend/sell_with_us/images/google-icon.png')}}"></a></li>
    					    </ul>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="copyright_main">
    	<div class="container">
    		<p class="copy_text">© 2018 All Rights Reserved. <a href="{{route('home')}}">riz.ecarto.co.uk</a></p>
    	</div>
    </div>


    <!-- contact end -->
    <!-- Javascript files-->
    <script src="{{asset('frontend/sell_with_us/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/sell_with_us/js/popper.min.js')}}"></script>
    <script src="{{asset('frontend/sell_with_us/js/bootstrap.bundle.min.js')}}"></script>


      <script src="{{asset('frontend/sell_with_us/js/jquery-3.0.0.min.js')}}"></script>
      <script src="{{asset('frontend/sell_with_us/js/plugin.js')}}"></script>
      <!-- sidebar -->
      <script src="{{asset('frontend/sell_with_us/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
      <script src="{{asset('frontend/sell_with_us/js/custom.js')}}"></script>
      <!-- javascript --> 
      <script src="{{asset('frontend/sell_with_us/js/owl.carousel.js')}}"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js')}}"></script>
      <script>
         $(document).ready(function(){
         $(".fancybox").fancybox({
         openEffect: "none",
         closeEffect: "none"
         });
         
         $(".zoom").hover(function(){
         
         $(this).addClass('transition');
         }, function(){
         
         $(this).removeClass('transition');
         });
         });
         </script> 
 
</body>
</html>



