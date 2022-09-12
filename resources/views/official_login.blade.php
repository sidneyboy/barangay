<!doctype html>
<html lang="en">

<head>
    <!--  meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Barangay Information & Management System</title>
</head>

<body>
    <br />
    <div class="container">
        <ul class="nav justify-content-center">
            <li class="nav-item" style="background-color:#62929E;">
                <a style="color:white" class="nav-link active" href="#home">Home</a>
            </li>
            <li class="nav-item" style="background-color:#62929E;">
                <a style="color:white" class="nav-link" href="#services">Services</a>
            </li>
            <li class="nav-item" style="background-color:#62929E;">
                <a style="color:white" class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item" style="background-color:#62929E;">
                <a style="color:white" class="nav-link" href="#">Contact</a>
            </li>
        </ul>
    </div>
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Barangay Information and Management System') }}</div>
                    <div class="card-body">
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
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

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
                                    <button type="submit" class="btn btn-success btn-sm">
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
    <br />
    <div id="services" class="container">
        <div class="card">
            <div class="card-header">
                Services
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <div class="card" style="background-color:#62929E">
                            <div class="card-body">
                                <b style="color:white">Data Back-ups and Security</b>
                                <p style="text-align: justify;color:white">
                                    Data back-up procedures and security protocols will be implemented during set-up and
                                    implementation
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <div class="card" style="background-color:#62929E">
                            <div class="card-body">
                                <b style="color:white"> Information Gathering and Import Support</b>
                                ​<br />
                                <p style="text-align: justify;color:white">
                                    There will be total import of all preexisting recorded information into the system.

                                    Training on how to Maximize use by knowing how to use the system as disaster
                                    prepareness
                                    and response tool.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <div class="card" style="background-color:#62929E">
                            <div class="card-body">

                                <b style="color:white">Organization Management</b>
                                ​

                                <p style="color:white">Organizing all your:</p>

                                <ul style="color:white">
                                    <li>Office information,</li>

                                    <li>Files,</li>
    
                                    <li>Transactions, and</li>
    
                                    <li>Activities Progress Tracking
    
                                        is also covered in this one system!.</li>
                                </ul>

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="features" class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js">
        < button class = "btn btn-success btn-sm" > HOME < /button>
    </script>
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>

</body>

</html>
