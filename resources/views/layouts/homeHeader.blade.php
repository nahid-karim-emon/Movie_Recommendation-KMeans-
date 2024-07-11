  <!-- Start Header -->
  <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')  | @isset($SiteOption) {{ $SiteOption[0]->value }} @endisset </title>

  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link href="{{  asset('vendor/fontawesome-free/css/all.min.css')  }}" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

</head>
<body>
<section id="header">
  <style>
    .modal-btn{
      width: 100% !important;
    }
  </style>
<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				   <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Login</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
					<div class="modal-body">
						<form method="POST" action="{{ route('login') }}" class="ps-3 pe-3">
              @csrf
							<div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <input required name="email" class="form-control" placeholder="Enter Email address" type="email" value="{{ old('email') }}">
              </div>
							<div class="mb-3">
                <label for="emailaddress" class="form-label">Password</label>
                <input required name="password" class="form-control" placeholder="Enter password" type="password" value="{{ old('password') }}">
              </div>
              <div class="mb-3 text-center">
                <button type="btn d-block" class="btn modal-btn "><h6 class="button_1 modal-btn"> Login </h6></button>
               </div>
              <hr>
              @if (Route::has('password.request'))
              <p class="text-center">Forgot Your Password?
                <a href="{{ route('password.request') }}">Request New Password</a>
              </p>
              @endif
              <hr>
              @if (Route::has('register'))
              <p class="text-center">Don't Have an account?
                  <a href="{{ route('register') }}" class="btn btn-block text-primary">
                      <i class="fa fa-signup m-2"></i>Create an Account</a>
              </p>
              @endif
              
            </form>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
<nav class="navbar navbar-expand-md navbar-light" id="navbar_sticky">
  <div class="container-fluid">
    <a class="navbar-brand fs-4 p-0 fw-bold text-uppercase" href="{{ route('root') }}">@isset($SiteOption) {{ $SiteOption[0]->value }} @endisset <i class="fa fa-film"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="flex-flow: row-reverse;">
      <ul class="navbar-nav mb-0">
	    
        <li class="nav-item">
          <a class="nav-link @if(request()->is('/')) active @endif" aria-current="page" href="{{ route('root') }}">Home</a>
        </li>
		<li class="nav-item">
          <a class="nav-link @if(request()->is('about')) active @endif" href="{{ route('root.about') }}">About </a>
        </li>				
        @auth('admin')
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle @if(request()->is('movie')) active @endif" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Movie</a>
          <ul class="dropdown-menu drop_1" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('movie.index') }}">All Movies in Front</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.movie.index') }}">View All</a></li>
            <li><a class="dropdown-item border-0" href="{{ route('admin.movie.create') }}">Add Movie</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Users</a>
          <ul class="dropdown-menu drop_1" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('admin.user.index') }}">View All</a></li>
            <li><a class="dropdown-item border-0" href="{{ route('admin.user.create') }}">Add User</a></li>
          </ul>
        </li>
        @else
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle @if(request()->is('movie')) active @endif" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Movie</a>
          <ul class="dropdown-menu drop_1" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('movie.index') }}">All Movies</a></li>
          </ul>
        </li>	
        @endauth
        @auth('admin')
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Panel</a>
          <ul class="dropdown-menu drop_1" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.profile.view') }}">Profile</a></li>
          </ul>
        </li>
        @else
            @if (Route::has('login'))
              @auth
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Recommendation</a>
                <ul class="dropdown-menu drop_1" aria-labelledby="navbarDropdown">
                  {{-- <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                  <li><a class="dropdown-item" href="{{ route('user.recommendation.view') }}">Recommendation (Euclidean)</a></li>
                  <li><a class="dropdown-item" href="{{ route('user.recommendation.viewm') }}">Recommendation (Manhantan)</a></li> --}}
                  <li><a class="dropdown-item" href="{{ route('user.recommendation.view8') }}">Recommendation (Collaborative Filtering usng Cosine similarity)</a></li>
                  <li><a class="dropdown-item" href="{{ route('user.recommendation.view7') }}">Recommendation (Based On Demographic Information)</a></li>
                  <li><a class="dropdown-item" href="{{ route('user.recommendation.view3') }}">Recommendation (K-Means Clustering)</a></li>
                  <li><a class="dropdown-item" href="{{ route('user.recommendation.view4') }}">Recommendation (K-Nearest Neighbour)</a></li>
                </ul>
              </li>
              {{-- <li><a class="dropdown-item" href="{{ route('user.profile.view') }}">Profile</a></li> --}}
              <li class="nav-item ms-3"><a class="nav-link" href="{{ route('user.dashboard')}}">User Panel</a></li>
              @else
		            <li class="nav-item"><a class="nav-link" data-bs-toggle="modal" data-bs-target="#signup-modal" href="#">Login</a></li>
		            {{-- <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li> --}}
                @if (Route::has('register'))
		            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.login') }}">Admin</a></li>
                @endif
              @endauth
            @endif
          {{-- <li class="nav-item"><a class="nav-link" href="{{ route('admin.login') }}">Admin</a></li> --}}
          @endauth
          <li class="nav-item"><a class="nav-link @if(request()->is('contact')) active @endif" href="{{ route('root.contact') }}">Contact</a></li>
          @auth
          <li class="nav-item ms-3"><a class="nav-link button" href="{{ route('logout') }}">Logout</a></li>
          @endauth
          @auth('admin')
          <li class="nav-item ms-3"><a class="nav-link button" href="{{ route('admin.logout') }}">Logout Admin</a></li>
          @endauth
      </ul>
    </nav><!-- .navbar -->
    
    </div>
  </div>
</nav>
</section>

  <!-- End Header -->
