<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="icon" type="image/x-icon" href="{{ asset($SiteOption[1]->value) }}" />
    <meta name="author" content="">

    <title> Register | @isset($SiteOption)
        {{ $SiteOption[0]->value }}
    @endisset </title>
    <!-- Custom fonts for this template-->
    <link href="{{  asset('vendor/fontawesome-free/css/all.min.css')  }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body>

    <section class="pt-5 pb-5 mt-0 align-items-center d-flex" style="min-height: 100vh; background-color: #D0A2F7; ">
        <div class="container-fluid">
          
          <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
            <div class="col-12 col-md-4 col-lg-4 h-50 ">
              <div class="card shadow">
                <div class="card-body mx-2">
                  @error('email')
                  <div class="text-bold bg-danger text-center text-white p-2">{{ $message }}</div>
                  @enderror

                  @error('password')
                  <div class="text-bold bg-danger text-center text-white p-2">{{ $message }}</div>
                  @enderror
                  <h4 class="card-title mt-3 text-center">Create An Account</h4>
                  {{-- <p class="text-center">Get started with your free account</p>
                  <p>
                    <a href="" class="btn btn-block btn-info">
                      <i class="fab fa-twitter mr-2"></i>Login via Twitter</a>
                    <a href="" class="btn btn-block btn-primary">
                      <i class="fab fa-facebook-f mr-2"></i>Login via facebook</a>
                  </p>
                  <p class="text-muted font-weight-bold ">
                    <span>OR</span>
                  </p> --}}
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                      </div>
                      <input required name="name" class="form-control" placeholder="Full name" type="text" value="{{ old('name') }}">
                    </div>
                    
                    <div class="form-group input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                      </div>
                      <input required name="email" class="form-control" placeholder="Email address" type="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                      </div>
                      <input required name="password" class="form-control" placeholder="Create password" type="password" value="{{ old('password') }}">
                    </div>
                    <div class="form-group input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                      </div>
                      <input required name="password_confirmation" class="form-control" placeholder="Repeat password" type="password" value="{{ old('password_confirmation') }}">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block"> Sign Up </button>
                    </div>
                    <hr>
                    <p class="text-center">Have an account ? 
                      <a href="{{ route('login') }}">Log In</a>
                    </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
     </section>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    @yield('scripts')


</body>

</html>
