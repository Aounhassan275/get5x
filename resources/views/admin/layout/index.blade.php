<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="GET 5X | BEST ONLINE EARNING SITE | No. 1 Marketing Forum to Earn Online.">
	<meta name="author" content="Bootlab">
    <title>ADMIN PANEL | GET 5X</title> 	

	<link rel="preconnect" href="{{asset('//fonts.gstatic.com/')}}" crossorigin="">

	<!-- PICK ONE OF THE STYLES BELOW -->
    <link href="{{asset('css/classic.css')}}" rel="stylesheet"> 
	<!-- <link href="{{asset('css/corporate.css')}}" rel="stylesheet"> -->
	<!-- <link href="{{asset('css/modern.css')}}" rel="stylesheet"> -->
	{{-- <script src="{{asset('js/settings.js')}}"></script> --}}

	<!-- BEGIN SETTINGS -->
	<!-- You can remove this after picking a style -->
	<style>
		body {
			opacity: 0;
		}
	</style>
	<!-- END SETTINGS -->
	@toastr_css
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content ">
				<a class="sidebar-brand" href="{{url('/')}}">
          			<i class="align-middle" data-feather="box"></i>
          			<span class="align-middle"> GET 5X</span>
        		</a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Admin Panel
                    </li>
                    <li class="sidebar-item {{Request::is('admin.dashboard.index')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.dashboard.index')}}">
							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>
					@if(Auth::user()->type == 2) 
					<li class="sidebar-item">
						<a href="{{url('#users')}}" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">User</span>
						</a>
						<ul id="users" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar"> 
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.user.index')}}">All User</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.user.actives')}}">Active User</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.user.pendings')}}">Pending User</a></li>

						</ul>
					</li>
					@else
					<li class="sidebar-item">
						<a href="{{url('#layouts')}}" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Packages</span>
						</a>
						<ul id="layouts" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.package.create')}}">Create Package</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.package.index')}}">View Package</a></li>
						</ul>
					</li>
					<li class="sidebar-item {{Request::is('admin.messages.index')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.messages.index')}}">
							<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Message</span>
						</a>
					</li>	
					<li class="sidebar-item {{Request::is('admin.email.index')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.email.index')}}">
							<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Emails</span>
						</a>
					</li>	
					<li class="sidebar-item {{Request::is('admin.ticker.index')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.ticker.index')}}">
							<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Ticker Message</span>
						</a>
					</li>	
					<li class="sidebar-item {{Request::is('admin.source.index')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.source.index')}}">
							<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Source</span>
						</a>
					</li>
					<li class="sidebar-item {{Request::is('admin.payment.index')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.payment.index')}}">
							<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Payment Way</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a href="{{url('#users')}}" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">User</span>
						</a>
						<ul id="users" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.user.index')}}">All User</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.user.actives')}}">Active User</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.user.pendings')}}">Pending User</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.user.blocks')}}">Block User</a></li>

						</ul>
					</li>
					<li class="sidebar-item">
						<a href="{{url('#deposit')}}" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Packages Deposit</span>
						</a>
						<ul id="deposit" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item "><a class="sidebar-link" href="{{route('admin.deposit.index')}}">Deposit Request</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.deposit.show')}}">Deposit History</a></li>
						</ul>
					</li>
					
					<li class="sidebar-item">
						<a href="{{url('#withdraw')}}" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Withdraw</span>
						</a>
						<ul id="withdraw" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item "><a class="sidebar-link" href="{{route('admin.withdraw.index')}}">In Process</a></li>
							<li class="sidebar-item "><a class="sidebar-link" href="{{route('admin.withdraw.holds')}}">On Hold</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.withdraw.complete')}}">Withdraw History</a></li>
						</ul>
					</li>
					<li class="sidebar-item {{Request::is('admin.admin.index')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.admin.index')}}">
							<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Add Employee</span>
						</a>
					</li>
					<li class="sidebar-item {{Request::is('admin/brand/*') || Request::is('admin/category') || Request::is('admin/product')  || Request::is('admin/order')  ?'active':''}}">
						<a href="{{url('#social')}}" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Social Section</span>
						</a>
						<ul id="social" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item {{Request::is('admin/category')?'active':''}}"><a class="sidebar-link" href="{{route('admin.category.index')}}">Manage Category</a></li>
							<li class="sidebar-item {{Request::is('admin/brand')?'active':''}}"><a class="sidebar-link" href="{{route('admin.brand.index')}}">Manage Brand</a></li>
							<li class="sidebar-item {{Request::is('admin/product')?'active':''}}"><a class="sidebar-link" href="{{route('admin.product.index')}}">Manage Product</a></li>
							<li class="sidebar-item {{Request::is('admin/product/create')?'active':''}}"><a class="sidebar-link" href="{{route('admin.product.create')}}">Create Products</a></li>
							<li class="sidebar-item {{Request::is('admin/order')?'active':''}}"><a class="sidebar-link" href="{{route('admin.order.index')}}">Orders</a></li>
						</ul>
					</li>	
					@endif
					<li class="sidebar-item {{Request::is('admin.profile.index')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.profile.index')}}">
							<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Profile</span>
						</a>
					</li>
				</ul>

				<div class="sidebar-bottom d-none d-lg-block">
					<div class="media">
						<img class="rounded-circle mr-3" src="{{asset('img\avatars\avatar.jpg')}}" alt="Chris Wood" width="40" height="40">
						<div class="media-body">
							<h5 class="mb-1"> GET 5X</h5>
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
                <img src="{{asset('img\avatars\avatar.jpg')}}" class="avatar img-fluid rounded-circle mr-1" alt="Chris Wood"> <span class="text-dark">Admin</span>
              </a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="{{route('admin.logout')}}">Sign out</a>
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
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="{{url('#')}}">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="{{url('#')}}">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="{{url('#')}}">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="{{url('#')}}">Terms of Service</a>
								</li>
							</ul>
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