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

    <div class="container-fluid">
        <div class="card" style="width: 100%;">
            <h6 class="card-header">Resident Registration</h6>
            <div class="card-body">
                <form action="{{ route('barangay_resident_register_process') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">

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
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">{{ __('First Name:') }}</label>
                                <input id="first_name" type="text"
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
                                <input id="middle_name" type="text"
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
                                <input id="last_name" type="text"
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
                                <select name="gender" id="gender" class="form-control">
                                    <option value="" default>Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="civil_status">{{ __('Civil Status:') }}</label>
                                <select name="civil_status" id="civil_status" class="form-control">
                                    <option value="" default>Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
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
                                <input id="birth_date" type="date"
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
                                <input id="contact_number" type="text"
                                    class="form-control @error('contact_number') is-invalid @enderror"
                                    name="contact_number" value="{{ old('contact_number') }}"
                                    autocomplete="contact_number" autofocus>

                                @error('contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="spouse">{{ __('Spouse Name:') }}</label>
                                <input id="spouse" type="text"
                                    class="form-control @error('spouse') is-invalid @enderror" name="spouse"
                                    value="{{ old('spouse') }}" autocomplete="spouse" autofocus>

                                @error('spouse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mothers_name">{{ __('Mothers Name:') }}</label>
                                <input id="mothers_name" type="text"
                                    class="form-control @error('mothers_name') is-invalid @enderror" name="mothers_name"
                                    value="{{ old('mothers_name') }}" autocomplete="mothers_name" autofocus>

                                @error('mothers_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fathers_name">{{ __('Fathers Name:') }}</label>
                                <input id="fathers_name" type="text"
                                    class="form-control @error('fathers_name') is-invalid @enderror" name="fathers_name"
                                    value="{{ old('fathers_name') }}" autocomplete="fathers_name" autofocus>

                                @error('fathers_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">{{ __('Email:') }}</label>
                                <input id="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="zone">{{ __('Zone:') }}</label>
                                <select name="zone" id="zone" class="form-control">
                                    <option value="" default>Select</option>
                                    @foreach ($zone as $data)
                                        <option value="{{ $data->id }}">{{ $data->zone }}</option>
                                    @endforeach
                                </select>

                                @error('zone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="voter">{{ __('Voter:') }}</label>
                                <select name="voter" id="voter" class="form-control">
                                    <option value="" default>Select</option>
                                    <option value="Voter">Voter</option>
                                    <option value="None Voter">None Voter</option>
                                </select>

                                @error('voter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" value="{{ $user->id }}" name="user_id">
                                <input type="hidden" value="{{ $user->barangay_id }}" name="barangay_id">
                                <br />
                                <button type="submit" class="btn btn-sm btn-success float-right">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection
