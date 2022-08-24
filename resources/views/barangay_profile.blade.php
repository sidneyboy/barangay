@extends('layouts.barangay_layout')

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
                        <form action="{{ route('barangay_profile_update_process') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Name:</label>
                                    <input type="text" required name="name" class="form-control"
                                        value="{{ $user->name }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="">Email:</label>
                                    <input type="text" required name="email" class="form-control"
                                        value="{{ $user->email }}">
                                </div>

                                <div class="col-md-12">
                                    <label for="">Contact Number:</label>
                                    <input type="text" required name="contact_number" class="form-control"
                                        value="{{ $user->contact_number }}">
                                </div>

                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">

                                </div>
                                <div class="col-md-12">
                                    <br />
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
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
                <form action="{{ route('barangay_profile_update_image') }}" method="post" enctype="multipart/form-data">
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
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button type="submit" class="btn btn-success btn-sm float-right">Update Photo</button>
                            <br />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
