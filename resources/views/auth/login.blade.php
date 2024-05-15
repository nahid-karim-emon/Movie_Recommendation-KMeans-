<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="icon" type="image/x-icon" href="{{ asset($SiteOption[1]->value) }}" />
    <meta name="author" content="">
    <title>Login | @isset($SiteOption){{ $SiteOption[0]->value }}@endisset</title>
    
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <!-- Custom styles for this page-->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: url('{{ asset($SiteOption[3]->value) }}') no-repeat center center fixed;
            background-size: cover;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .login-card:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .login-card .card-body {
            padding: 2rem;
        }

        .login-card .form-group {
            margin-bottom: 1.5rem;
        }

        .login-card .input-group-text {
            background-color: #f8f9fa;
            border: none;
        }

        .login-card .form-control {
            border-left: none;
        }

        .login-card .btn-primary {
            background-color: #4e73df;
            border: none;
            transition: background-color 0.3s ease-in-out;
        }

        .login-card .btn-primary:hover {
            background-color: #2e59d9;
        }

        .login-card .text-center a {
            color: #4e73df;
            transition: color 0.3s ease-in-out;
        }

        .login-card .text-center a:hover {
            color: #2e59d9;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="col-md-6">
            <div class="card login-card shadow">
                <div class="card-body">
                    @error('email')
                    <div class="alert alert-danger text-center">{{ $message }}</div>
                    @enderror
                    @error('password')
                    <div class="alert alert-danger text-center">{{ $message }}</div>
                    @enderror
                    <h4 class="card-title text-center mb-4">Login</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="sr-only">Email Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                </div>
                                <input required name="email" id="email" class="form-control" placeholder="Enter Email address" type="email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input required name="password" id="password" class="form-control" placeholder="Enter password" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Login </button>
                        </div>
                    </form>
                    <hr>
                    @if (Route::has('password.request'))
                    <p class="text-center">Forgot Your Password?
                        <a href="{{ route('password.request') }}">Request New Password</a>
                    </p>
                    @endif
                    @if (Route::has('register'))
                    <p class="text-center">Don't Have an account?
                        <a href="{{ route('register') }}" class="btn btn-info btn-sm">
                            <i class="fa fa-sign-up-alt mr-2"></i>Create an Account</a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
