<!doctype html>
<html lang="en">

<head>
    <!--  meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <title>Barangay Information & Management System</title>
</head>

<body style="background-color:#008080">
    <br />
    <div class="container">
        <div style="margin-left: 35px;">
            <img src="{{ asset('/storage/barangay_logo.jpeg') }}"
                style="width:60px;
                float: left; 
                margin-right: 10px;border:0px;"
                 alt="">
            <div style="font-size: 20px;color:white">Barangay Information Management System</div>
        </div>
    </div>
    <br />

    <div class="container">
        <ul class="nav justify-content-center">
            <li class="nav-item" style="background-color:#62929E;margin-left:20px;border-radius:20px;">
                <a style="color:white" class="nav-link active" href="#login">Login</a>
            </li>
            <li class="nav-item" style="background-color:#62929E;margin-left:20px;border-radius:20px;">
                <a style="color:white" class="nav-link" href="#services">Services</a>
            </li>
            <li class="nav-item" style="background-color:#62929E;margin-left:20px;border-radius:20px;">
                <a style="color:white" class="nav-link" href="#reminder">Reminder</a>
            </li>
        </ul>
    </div>
    <br />

    <div class="container" id="login">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-radius: 30px;">
                    {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                    <div class="card-body">
                        <center>
                            <h3>Login</h3>
                        </center>
                        <div class="container">
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('official_login_process') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                aria-label="Username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"
                                                    style="background-color:transparent;"><i
                                                        class="bi bi-person-check-fill"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input id="password" type="password" required
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" autocomplete="new-password">
                                            <div class="input-group-append">
                                                <span class="input-group-text" style="background-color: transparent"
                                                    onclick="password_show_hide();">
                                                    <i class="fas fa-eye" id="show_eye"></i>
                                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                                </span>
                                            </div>
                                        </div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
  
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-success btn-sm btn-block">
                                            {{ __('Login') }}
                                        </button>

                                        {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
    <div id="services" class="container">
        <div class="card" style="border-radius: 30px;">
            <div class="card-body">
                <center>
                    <h3>Services</h3>
                </center>
                <br />
                <b>In this application you are able to do these actions</b> :<br />
                <br />

                <ul>
                    <li>Request documents</li>
                    <li>Request Assistance</li>
                    <li>Complain</li>
                    <li>Check your record of complaints
                    </li>
                    <li>Check your record of requested documents
                    </li>
                    <li> Check your record of requested assistance
                    </li>
                    <li>Modify your photo
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <br />
    <div id="reminder" class="container">
        <div class="card" style="border-radius: 30px;">
            <div class="card-header">
                <div class="card-body">
                    <center>
                        <h3>Reminder</h3>
                    </center>
                    <br />
                    Online transactions are made easier by providing each resident a credentials that will be use to log
                    in. <br />
                    ​
                    <li>Make sure that you are registered to your barangay</li>
                    <li>Use active email address</li>
                    <li>Check email to know your credentials</li>
                    <li>Use your account gently</li>
                    <li>If you forget your password, check email.</li>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>

</body>

</html>
