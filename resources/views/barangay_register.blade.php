@extends('layouts.barangay_layout')

@section('content')
    <div class="card" style="width: 100%;">
        <h6 class="card-header">Register Barangay Officials</h6>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('barangay_register_process') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="form-group">

                            <img id="blah" class="img img-thumbnail" src="{{ asset('storage/default_image.jpg') }}"
                                alt="your image" />

                            <input type="file" min="0" required
                                class="form-control form-control-user  @error('user_image') is-invalid @enderror"
                                name="user_image" value="{{ old('user_image') }}" autofocus accept="image/*"
                                id="imgInp" />



                            @error('user_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">{{ __('First Name:') }}</label>
                            <input id="first_name" type="text" required
                                class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                value="{{ old('first_name') }}" autocomplete="first_name" autofocus>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle_name">{{ __('Middle Name:') }}</label>
                            <input id="middle_name" type="text" required
                                class="form-control @error('middle_name') is-invalid @enderror" name="middle_name"
                                value="{{ old('middle_name') }}" autocomplete="middle_name" autofocus>

                            @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">{{ __('Last Name:') }}</label>
                            <input id="last_name" type="text" required
                                class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                value="{{ old('last_name') }}" autocomplete="last_name" autofocus>

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gender">{{ __('Gender:') }}</label>
                            <select name="gender" id="gender" required class="form-control">
                                <option value="" default>Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="civil_status">{{ __('Civil Status:') }}</label>
                            <select name="civil_status" id="civil_status" required class="form-control">
                                <option value="" default>Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widow">Widow</option>
                                <option value="Divorced">Divorced</option>
                            </select>

                            @error('civil_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="birth_date">{{ __('Birth Date:') }}</label>
                            <input id="birth_date" type="date" required
                                class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                                value="{{ old('birth_date') }}" autocomplete="birth_date" autofocus>

                            @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="contact_number">{{ __('Contact Number:') }}</label>
                            <input id="contact_number" type="text" required
                                class="form-control @error('contact_number') is-invalid @enderror" name="contact_number"
                                value="{{ old('contact_number') }}" autocomplete="contact_number" autofocus>

                            @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="spouse">{{ __('Spouse Name:') }}</label>
                            <input id="spouse" type="text" required
                                class="form-control @error('spouse') is-invalid @enderror" name="spouse"
                                value="{{ old('spouse') }}" autocomplete="spouse" autofocus>

                            @error('spouse')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="office_term">{{ __('Office Term:') }}</label>
                            <input id="office_term" type="text" required
                                class="form-control @error('office_term') is-invalid @enderror" name="office_term"
                                value="{{ old('office_term') }}" autocomplete="office_term" autofocus>

                            @error('office_term')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="position_type_id">{{ __('Position:') }}</label>
                            <select name="position_type_id" id="position_type_id" required class="form-control">
                                <option value="" default>Select</option>
                                @foreach ($position as $data)
                                    <option value="{{ $data->id }}">{{ $data->title }}</option>
                                @endforeach
                            </select>

                            @error('position_type_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email">{{ __('Email:') }}</label>
                            <input id="email" type="text" required
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="password">{{ __('Password:') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                value="{{ old('password') }}" autocomplete="password" autofocus>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm_password:') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" autocomplete="new-password">

                            @error('password-confirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">

                            <br />
                            <button type="submit" class="btn btn-sm btn-success float-right">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $("#civil_status").change(function() {
            if ($(this).val() == 'Single') {
                $('#spouse').val('na');
            } else {
                $('#spouse').val('');
            }
        });
    </script>
@endsection
