
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="GET 5X | BEST ONLINE EARNING SITE | No. 1 Marketing Forum to Earn Online.">
	<meta name="author" content="Bootlab">


    <title>SIGN IN | GET 5X</title>   

	<link rel="preconnect" href="{{asset('//fonts.gstatic.com/')}}'" crossorigin="">

	<!-- PICK ONE OF THE STYLES BELOW -->
    <link href="{{asset('css/classic.css')}}" rel="stylesheet">	
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet">	
    <!-- <link href="css/corporate.css" rel="stylesheet"> -->
	<!-- <link href="css/modern.css" rel="stylesheet"> -->

	<!-- BEGIN SETTINGS -->
	<!-- You can remove this after picking a style -->
	<style>
		body {
			opacity: 0;
		}
	</style>
	<script src="{{asset('js\settings.js')}}"></script>
    <!-- END SETTINGS -->
    <script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1685936,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    	@toastr_css
</head>

<body>
    <main class="main d-flex justify-content-center w-100">
        <div class="container d-flex flex-column">
            <div class="row h-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
    
                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome back, GET 5X</h1>
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>
    
                        <div class="card">
                            <div class="card-body"> 
                                <div class="m-sm-4">
                                <form method="POST" action="{{route('user.login')}}">
                                    @csrf
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input class="form-control form-control-lg" type="text" name="name" placeholder="Enter username">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password">
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    </main>

	<script src="{{asset('js\app.js')}}"></script>
	@toastr_js
	@toastr_render
</body>

</html>