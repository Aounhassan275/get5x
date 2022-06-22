<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet"  href="{{asset('front/css/bootstrap.min.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet"  href="{{asset('front/css/font-awesome.min.css')}}">
    
    <!-- Custom CSS -->
    <link rel="stylesheet"  href="{{asset('front/css/owl.carousel.css')}}">
    <link rel="stylesheet"  href="{{asset('front/css/style.css')}}">
    <link rel="stylesheet"  href="{{asset('front/css/responsive.css')}}">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @toastr_css
  </head>
  <body>
   
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            @if(Auth::user()->checkstatus() =='old')
                            <li><a href="{{route('user.product.index')}}"><i class="fa fa-user"></i> Products</a></li>
                            <li><a href="{{route('user.order.index')}}"><i class="fa fa-user"></i> Orders</a></li>
                            @endif
                            <li><a href="#"><i class="fa fa-user"></i> {{Auth::user()->name}}</a></li>
                            <li><a href="{{route('user.logout')}}"><i class="fa fa-user"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div> <!-- End header area -->
    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="{{url('/')}}"><img style="width:150px;" src="{{asset('logo.jpeg')}}"></a></h1>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
						@if (Auth::user()->checkstatus() =='old')
							<li><a href="{{route('user.dashboard.index')}}" class="{{Request::is('user/dashboard')?'active':''}}">Dashboard</a></li>
							<li><a href="{{route('user.package.index')}}" class="{{Request::is('user/package')?'active':''}}">Package</a></li>
							<li><a href="{{route('user.withdraw.create')}}" class="{{Request::is('user/withdraw/create')?'active':''}}">Create Withdraw Request</a></li>
							<li><a href="{{route('user.withdraw.index')}}" class="{{Request::is('user/withdraw')?'active':''}}">Manage Withdraw Request</a></li>
							<li><a href="{{route('user.refer.index')}}" class="{{Request::is('user/refer')?'active':''}}">Refferral</a></li>
							<li><a href="{{url('user/direct_earning')}}" class="{{Request::is('user/direct_earning')?'active':''}}">Direct Earning</a></li>
							<li><a href="{{url('user/matching_earning')}}" class="{{Request::is('user/matching_earning')?'active':''}}">Matching Earning</a></li>
							<li><a href="{{route('user.user.index')}}" class="{{Request::is('user/user')?'active':''}}">Profile</a></li>
						@elseif (Auth::user()->checkstatus() =='fresh')
							@if (Auth::user()->status=='pending')
								<li><a href="{{route('user.dashboard.index')}}" class="{{Request::is('user/dashboard')?'active':''}}">Dashboard</a></li>
								<li><a href="{{route('user.package.index')}}" class="{{Request::is('user/package')?'active':''}}">Package</a></li>
							@elseif(Auth::user()->status=='onHold')
								<li><a href="{{route('user.dashboard.index')}}" class="{{Request::is('user/dashboard')?'active':''}}">Dashboard</a></li>
								<li><a href="#" >Package Pending Wait Please</a></li>
							@endif
						@endif
					</ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
    @yield('content')
    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>get<span>5X</span></h2>                        
                        
                    </div>
                </div>
                
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            @foreach(App\Models\Category::take(10)->get() as $category)
                            <li><a href="{{route('category.show',str_replace(' ', '_',$category->name))}}"> <span class="pull-right">({{$category->products->count()}})</span>{{@$category->name}}</a></li>
                            @endforeach
                            <li><a href="{{route('category.index')}}"> <span class="pull-right">({{App\Models\Category::count()}})</span>All Categories</a></li>

                        </ul>                        
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Brands</h2>
                        <ul>
                            @foreach(App\Models\Brand::take(10)->get() as $brand)
                            <li><a href="{{route('brand.show',str_replace(' ', '_',$brand->name))}}"> <span class="pull-right">({{$brand->products->count()}})</span>{{@$brand->name}}</a></li>
                            @endforeach
                            <li><a href="{{route('brand.index')}}"> <span class="pull-right">({{App\Models\Brand::count()}})</span>All Brands</a></li>

                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Social Links</h2>
                        <div class="footer-social">
                            <a href="https://www.facebook.com/112269564835093/posts/pfbi/?app=" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.facebook.com/groups/1730526797300451/?ref=share" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        </div>                     
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer top area -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>&copy; 2022.All Rights Reserved. <a href="{{url('/')}}" target="_blank">get5x.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->
   
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('front/js/jquery.sticky.js')}}"></script>
    
    <!-- jQuery easing -->
    <script src="{{asset('front/js/jquery.easing.1.3.min.js')}}"></script>
    
    <!-- Main Script -->
    <script src="{{asset('front/js/main.js')}}"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="{{asset('front/js/bxslider.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/js/script.slider.js')}}"></script>
    @toastr_js
    @toastr_render
    @yield('scripts')
  </body>
</html>