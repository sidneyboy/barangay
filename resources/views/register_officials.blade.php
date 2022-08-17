@extends('layouts.barangay_layout')

@section('content')
    <div class="card" style="width: 100%;">
        <h6 class="card-header">Register Barangay Officials</h6>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="first_name">{{ __('First Name:') }}</label>
                        <input id="first_name" type="first_name"
                            class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                            value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

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
                        <input id="middle_name" type="middle_name" class="form-control @error('middle_name') is-invalid @enderror"
                            name="middle_name" value="{{ old('middle_name') }}" required autocomplete="middle_name" autofocus>

                        @error('middle_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="position">{{ __('Official Name:') }}</label>
                        <input id="position" type="position" class="form-control @error('position') is-invalid @enderror"
                            name="position" value="{{ old('position') }}" required autocomplete="position" autofocus>

                        @error('position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
