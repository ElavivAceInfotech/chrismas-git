<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Christmas Gift</title>

    <!-- Bootstrap core CSS -->
	<link href="{{ URL::to('public/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ URL::to('public/css/one-page-wonder.min.css') }}" rel="stylesheet">

  </head>

  <body>
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Christmas Gift</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
			@auth
			<a href="{{ url::to('admin/home') }}">Home</a>
			@else
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/register') }}">Sign Up</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/login') }}">Log In</a>
            </li>
			@endauth
          </ul>
        </div>
      </div>
    </nav>
<div style="margin-top: 10%;"></div>
<div class="container-fluid">
<div class="container">
	<div class="row" style="margin:10% 0px;">
		<div class="col-md-2">&nbsp;</div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <!--<div class="panel-heading">Christmas Gifts Login</div>-->
                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <!-- <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->

                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="E-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                            <div class="col-md-12">
                                <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						
                        <div class="form-group row">
                            <div class="col-md-12">
								<a href="{{ route('register') }}">Register</a> | 
								<a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
							</div>
						</div>	

						<div class="form-group row">
                            <div class="col-md-12">
                                <label>
									<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
								</label>
							</div>
						</div>

                        <div class="form-group row mb-4">
                            <div class="col-md-12 offset-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		<div class="col-md-2">&nbsp;</div>
    </div>
</div>
</div>
<footer class="py-5 bg-black">
      <div class="container">
        <p class="m-0 text-center text-white small">Copyright &copy; Christmas Gift 2018</p>
      </div>
      <!-- /.container -->
    </footer>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="{{ URL::to('public/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  </body>

</html>