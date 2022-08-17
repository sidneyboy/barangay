@extends('layouts.barangay_layout')

@section('content')
    <div class="card" style="width: 18rem;">
        <h6 class="card-header">Position Type</h6>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input id="title" type="title"
                            class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{ old('title') }}" required autocomplete="title" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('') }}</label>
                        <input id="" type=""
                            class="form-control @error('') is-invalid @enderror" name=""
                            value="{{ old('') }}" required autocomplete="" autofocus>

                        @error('')
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
