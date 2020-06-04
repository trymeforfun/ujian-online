<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login Page</title>

  <!-- Custom fonts for this template-->
<link href="{{url('/asset/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
<link href="{{url('/asset/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gray-100">
{{-- <img src="{{url('/asset/img/img2.jpg')}}" alt=""> --}}
  <div class="container ">

    <!-- Outer Row -->
    <div class="row justify-content-center mx-auto">

      <div class="col-xl-6 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0" >
            <!-- Nested Row within Card Body -->
            <div class="row mx-auto">
            {{-- <div class="col-lg-6 d-none d-lg-block "></div> --}}
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome !</h1>
                  </div>
                  @if (session('status'))
                      <div class="alert alert-danger">
                          {{ session('status') }}
                      </div>
                  @endif
                    <form class="user" action="{{ '/login' }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <input type="username" class="form-control form-control-user @error('username') is-invalid @enderror" id="exampleInputusername" aria-describedby="usernameHelp" placeholder="Enter Username... " name="username">
                      @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                       @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Input Your Password..." name="password">
                      @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-user btn-block">
                        {{ __('Login') }}
                    </button>
                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
<script src="{{url('/asset/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{url('/asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
<script src="{{url('/asset/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
<script src="{{url('/asset/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
