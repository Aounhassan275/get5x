<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="GET 5X | BEST ONLINE EARNING SITE | No. 1 Marketing Forum to Earn Online.">

	<meta name="author" content="Bootlab">

    <title>USER PANEL | GET 5X</title> 	



	<link rel="preconnect" href="{{asset('//fonts.gstatic.com/')}}" crossorigin="">



	<!-- PICK ONE OF THE STYLES BELOW -->

    <link href="{{asset('css/classic.css')}}" rel="stylesheet"> 

	<!-- <link href="{{asset('css/corporate.css')}}" rel="stylesheet"> -->

	<!-- <link href="{{asset('css/modern.css')}}" rel="stylesheet"> -->



	<!-- BEGIN SETTINGS -->

	<!-- You can remove this after picking a style -->

	<style>

		body {

			opacity: 0;

		}

	</style>

	@yield('style')

	<!-- END SETTINGS -->



	@toastr_css

</head>



<body>

	<div class="wrapper">

		<nav id="sidebar" class="sidebar">

			<div class="sidebar-content ">

				<a class="sidebar-brand" href="{{url('/')}}">

          			<i class="align-middle" data-feather="box"></i>

          			<span class="align-middle">GET 5X</span>

        		</a>

				<ul class="sidebar-nav">
				<li class="sidebar-header">

{{Auth::user()->fname}}
					</li>

					@if (Auth::user()->checkstatus() =='old')

					<li class="sidebar-header">

						Active User Panel

					</li>

					

                    <li class="sidebar-item {{Request::is('user.dashboard.index')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.dashboard.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Dashboard</span>

						</a>

					</li>

					<li class="sidebar-item">

						<a href="{{url('#layouts')}}" data-toggle="collapse" class="sidebar-link collapsed">

							<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Withdraw</span>

						</a>

						<ul id="layouts" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">

							<li class="sidebar-item"><a class="sidebar-link" href="{{route('user.withdraw.create')}}">Create Withdraw Request</a></li>

							<li class="sidebar-item"><a class="sidebar-link" href="{{route('user.withdraw.index')}}">View Withdraw Requests</a></li>

						</ul>
					</li>		
					<li class="sidebar-item {{Request::is('user.refer.index')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.refer.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Referral</span>

						</a>

					</li>

					<li class="sidebar-item {{Request::is('user.user.index')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.user.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Profile</span>

						</a>

					</li>


				
					@elseif (Auth::user()->checkstatus() =='fresh')

					@if (Auth::user()->status=='pending')
					<li class="sidebar-header">

						Pending User Panel

					</li>

					

                    <li class="sidebar-item {{Request::is('user.dashboard.index')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.dashboard.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Dashboard</span>

						</a>

					</li>
					<li class="sidebar-item {{Request::is('user.package.-*')?'active':''}}">

                        <a class="sidebar-link" href="{{route('user.package.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Package</span>

						</a>

					</li>

					@elseif(Auth::user()->status=='onHold')

					<li class="sidebar-header">

						On Hold User Panel

					</li>

					

                    <li class="sidebar-item {{Request::is('user.dashboard.index')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.dashboard.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Dashboard</span>

						</a>

					</li>

					@endif
					@elseif (Auth::user()->checkstatus() =='expired')
					@if(Auth::user()->status=='active')
					<li class="sidebar-header">

						Expired User Panel

					</li>

					

                    <li class="sidebar-item {{Request::is('user.dashboard.index')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.dashboard.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Dashboard</span>

						</a>

					</li>
					<li class="sidebar-item {{Request::is('user.package.-*')?'active':''}}">

                        <a class="sidebar-link" href="{{route('user.package.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Package</span>

						</a>

					</li>

					<li class="sidebar-item">

						<a href="{{url('#layouts')}}" data-toggle="collapse" class="sidebar-link collapsed">

							<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Withdraw</span>

						</a>

						<ul id="layouts" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">

							<li class="sidebar-item"><a class="sidebar-link" href="{{route('user.withdraw.create')}}">Create Withdraw Request</a></li>

							<li class="sidebar-item"><a class="sidebar-link" href="{{route('user.withdraw.index')}}">View Withdraw Requests</a></li>

						</ul>

					</li>

					<li class="sidebar-item {{Request::is('user.refer.index')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.refer.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Referral</span>

						</a>

					</li>


					<li class="sidebar-item {{Request::is('user.user.index')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.user.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Profile</span>

						</a>

					</li>

					@elseif(Auth::user()->status=='onHold')

					<li class="sidebar-header">

						On Hold User Panel

					</li>

					

                    <li class="sidebar-item {{Request::is('user.dashboard.index')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.dashboard.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Dashboard</span>

						</a>

					</li>
					<li class="sidebar-item">

						<a href="{{url('#layouts')}}" data-toggle="collapse" class="sidebar-link collapsed">

							<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Withdraw</span>

						</a>

						<ul id="layouts" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">

							<li class="sidebar-item"><a class="sidebar-link" href="{{route('user.withdraw.create')}}">Create Withdraw Request</a></li>

							<li class="sidebar-item"><a class="sidebar-link" href="{{route('user.withdraw.index')}}">View Withdraw Requests</a></li>

						</ul>

					</li>


					<li class="sidebar-item {{Request::is('user.refer.index')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.refer.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Referral</span>

						</a>

					</li>


					<li class="sidebar-item {{Request::is('user.user.index')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.user.index')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Profile</span>

						</a>

					</li>

					@endif
					@endif
						<li class="sidebar-item {{Request::is('user.logout')?'active':''}}">

						<a class="sidebar-link" href="{{route('user.logout')}}">

							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Logout</span>

						</a>

					</li>
					</ul>



				<div class="sidebar-bottom d-none d-lg-block">

					<div class="media">


						<div class="media-body">

							<h5 class="mb-1">GET 5X</h5>

							<div>

								<i class="fas fa-circle text-success"></i> Online

							</div>

						</div>

					</div>

				</div>



			</div>

		</nav>



		<div class="main">

			<nav class="navbar navbar-expand navbar-light bg-white">

				<a class="sidebar-toggle d-flex mr-2">

          			<i class="hamburger align-self-center"></i>

       			</a>
				<div class="navbar-collapse collapse">

					<ul class="navbar-nav ml-auto">

					

						<li class="nav-item dropdown">

						



							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="{{url('#')}}" data-toggle="dropdown">


               </a>

							<div class="dropdown-menu dropdown-menu-right">

								<a class="dropdown-item" href="{{route('user.logout')}}">Sign out</a>

							</div>

						</li>

					</ul>

				</div>

			</nav>



			<main class="content">

				<div class="container-fluid p-0">


					@yield('contents')

				

				</div>

			</main>



			<footer class="footer">

				<div class="container-fluid">

					<div class="row text-muted">

						<div class="col-6 text-left">


						</div>

						<div class="col-6 text-right">

							<p class="mb-0">

								&copy; 2020 - <a href="{{url('/')}}" class="text-muted">GET 5X</a>

							</p>

						</div>

					</div>

				</div>

			</footer>

		</div>

	</div>



	<script src="{{asset('js\app.js')}}"></script>

	@toastr_js

	@toastr_render

	@yield('scripts')

</body>



</html>