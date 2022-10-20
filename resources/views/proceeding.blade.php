<!doctype html>
<html lang="en">

<head>
    <!--  meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <title>Barangay Information & Management System</title>
</head>

<body>
    <br />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register Barangay Admin') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('proceeding_register') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- <div class="row mb-3">
                                <label for="invitation_code"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Invitation Code') }}</label>

                                <div class="col-md-6">
                                    <input id="invitation_code" type="text"
                                        required class="form-control @error('invitation_code') is-invalid @enderror"
                                        name="invitation_code" value="{{ old('invitation_code') }}"
                                        autocomplete="invitation_code" autofocus>

                                    @error('invitation_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}


                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        required class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="middle_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Middle Name') }}</label>

                                <div class="col-md-6">
                                    <input id="middle_name" type="text"
                                        required class="form-control @error('middle_name') is-invalid @enderror"
                                        name="middle_name" value="{{ old('middle_name') }}"
                                        autocomplete="middle_name" autofocus>

                                    @error('middle_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="last_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                        required class="form-control @error('last_name') is-invalid @enderror"
                                        name="last_name" value="{{ old('last_name') }}" autocomplete="last_name"
                                        autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="contact_number"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Contact Number') }}</label>

                                <div class="col-md-6">
                                    <input id="contact_number" type="text"
                                        required class="form-control @error('contact_number') is-invalid @enderror"
                                        name="contact_number" value="{{ old('contact_number') }}"
                                        autocomplete="contact_number" autofocus>

                                    @error('contact_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="zip_code"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Zip Code') }}</label>

                                <div class="col-md-6">
                                    <input id="zip_code" type="text"
                                        required class="form-control @error('zip_code') is-invalid @enderror"
                                        name="zip_code" value="{{ old('zip_code') }}"
                                        autocomplete="zip_code" autofocus>

                                    @error('zip_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        required class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email">

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
                                    <div class="input-group mb-3">
                                        <input id="password" type="password"
                                            required class="form-control @error('password') is-invalid @enderror"
                                            name="password" autocomplete="new-password">
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="password_show_hide();">
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

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input id="password-confirm" type="password" required class="form-control"
                                            name="password_confirmation" autocomplete="new-password">
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="password_cofirm_show_hide();">
                                                <i class="fas fa-eye" id="show_eye_2"></i>
                                                <i class="fas fa-eye-slash d-none" id="hide_eye_2"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Barangay Admin Image"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Barangay Admin Image') }}</label>

                                <div class="col-md-6">
                                    <input type="file" min="0"
                                        required class="form-control form-control-user  @error('user_image') is-invalid @enderror"
                                        name="user_image" value="{{ old('user_image') }}" autofocus accept="image/*"
                                        id="imgInp" />

                                    <img id="blah" class="img img-thumbnail"
                                        src="{{ asset('images/default_image.jpg') }}" alt="your image"
                                        class="img img-thumbnail" />
                                </div>

                                @error('user_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {{-- <input type="hidden" name="latitude" value="{{ $latitude }}">
                                    <input type="hidden" name="longitude" value="{{ $longitude }}"> --}}
                                    <input type="hidden" name="provCode" value="{{ $provCode }}">
                                    <input type="hidden" name="citymunCode" value="{{ $citymunCode }}">
                                    <input type="hidden" name="regCode" value="{{ $regCode }}">
                                    <input type="hidden" name="brgyCode" value="{{ $brgyCode }}">
                                    <input type="hidden" name="brgyDesc" value="{{ $brgyDesc }}">
                                    <input type="hidden" name="latitude" value="{{ $latitude }}">
                                    <input type="hidden" name="longitude" value="{{ $longitude }}">
                                    <button type="submit" class="btn btn-success btn-sm float-right">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
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

        function password_cofirm_show_hide() {
            var x = document.getElementById("password-confirm");
            var show_eye_2 = document.getElementById("show_eye_2");
            var hide_eye_2 = document.getElementById("hide_eye_2");
            hide_eye_2.classList.remove("d-none");
            if (x.type === "password-confirm") {
                x.type = "text";
                show_eye_2.style.display = "none";
                hide_eye_2.style.display = "block";
            } else {
                x.type = "password-confirm";
                show_eye_2.style.display = "block";
                hide_eye_2.style.display = "none";
            }
        }

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>

</body>

</html>
