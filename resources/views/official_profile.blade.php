@extends('layouts.staff_layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card" style="width: 100%;">
                <h6 class="card-header">Profile</h6>
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{ route('official_profile_update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">First Name:</label>
                                    <input type="text" required name="first_name" class="form-control"
                                        value="{{ $user->first_name }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Middle Name:</label>
                                    <input type="text" required name="middle_name" class="form-control"
                                        value="{{ $user->middle_name }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Last Name:</label>
                                    <input type="text" required name="last_name" class="form-control"
                                        value="{{ $user->last_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Gender:</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="{{ $user->gender }}">{{ $user->gender }}
                                            Current</option>
                                        @if ($user->gender == 'Male')
                                            <option value="Female">Female
                                            </option>
                                        @else
                                            <option value="Male">Male
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Civil Status:</label>
                                    <select name="civil_status" class="form-control" required>
                                        <option value="{{ $user->civil_status }}">
                                            {{ $user->civil_status }}
                                            Current</option>
                                        @if ($user->civil_status == 'Single')
                                            <option value="Married">Married
                                            </option>
                                        @else
                                            <option value="Single">Single
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Birth Date:</label>
                                    <input type="text" required name="birth_date" class="form-control"
                                        value="{{ $user->birth_date }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Contact Number:</label>
                                    <input type="text" required name="contact_number" class="form-control"
                                        value="{{ $user->contact_number }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Email:</label>
                                    <input type="text" required name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ $user->email }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="">Spouse:</label>
                                    <input type="text" required name="spouse" class="form-control"
                                        value="{{ $user->spouse }}">

                                    <input type="hidden" value="{{ $user->id }}" name="official_id">
                                </div>
                                <div class="col-md-4">
                                    <label for="password">{{ __('New Password') }}</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-md-4">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">

                                </div>
                                <div class="col-md-12">
                                    <br />
                                    <button class="btn btn-success btn-sm float-right">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <h6 class="card-header">Photo</h6>
                <form action="{{ route('official_profile_update_image') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12">
                            <img src="{{ asset('/storage/' . $user->user_image) }}" alt=""
                                class="img img-thumbnail">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <h6>Change Photo Preview Below</h6>
                        </div>
                        <div class="col-md-12">
                            <br />
                            <img id="blah" class="img img-thumbnail" src="{{ asset('storage/default_image.jpg') }}"
                                alt="your image" />

                            <input type="file" min="0"
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
                    <div class="card-footer">
                        <div class="form-group">
                            <input type="hidden" value="{{ $user->id }}" name="official_id">
                            <button type="submit" class="btn btn-success btn-sm float-right">Update Photo</button>
                            <br />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
