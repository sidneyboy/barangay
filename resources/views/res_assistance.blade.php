@extends('layouts.resident_layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card" style="width: 100%;">
        <h6 class="card-header">Request Assistance Section</h6>
        <div class="card-body">
            <form action="{{ route('res_assistance_process') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="assistance_type_id">{{ __('Assitance Type:') }}</label>
                            <select class="form-control @error('assistance_type_id') is-invalid @enderror" name="assistance_type_id" id="assistance_type_id"
                                value="{{ old('assistance_type_id') }}" autofocus>
                                <option value="" default>Select</option>
                                @foreach ($assistance_type as $data)
                                    <option value="{{ $data->id }}">{{ $data->title }}</option>
                                @endforeach
                            </select>

                            @error('assistance_type_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="explanation">{{ __('Explanation') }}</label>
                            <textarea id="explanation" type="explanation" class="form-control @error('explanation') is-invalid @enderror"
                                name="explanation" value="{{ old('explanation') }}" autocomplete="explanation" autofocus>
                                      </textarea>

                            @error('explanation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br />

                            <img id="blah" class="img img-thumbnail" src="{{ asset('storage/default_image.jpg') }}"
                                alt="your image" />

                            <input type="file" min="0"
                                class="form-control form-control-user  @error('image') is-invalid @enderror"
                                name="image" value="{{ old('image') }}" autofocus accept="image/*"
                                id="imgInp" />

                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <br />
                        <input type="hidden" name="resident_id" value="{{ $resident->id }}">
                        <input type="hidden" name="barangay_id" value="{{ $resident->barangay_id }}">
                        <button type="submit" class="btn btn-sm btn-success float-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
