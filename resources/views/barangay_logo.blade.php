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
        <div class="col-md-6">
            <div class="card" style="width: 100%;">
                <div class="card-header">Upload Barangay Logo</div>
                <div class="card-body">
                    <form action="{{ route('barangay_logo_process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <img id="blah" class="img img-thumbnail" src="{{ asset('storage/default_image.jpg') }}"
                                    alt="your image" />
                                <input type="file" min="0"
                                    class="form-control form-control-user  @error('logo') is-invalid @enderror"
                                    name="logo" value="{{ old('logo') }}" autofocus accept="image/*" id="imgInp" />

                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input type="hidden" value="{{ $user->barangay_id }}" name="barangay_id">
                                <input type="hidden" value="{{ $user->id }}" name="user_id">
                            </div>
                            <div class="col-md-12">
                                <br />
                                <button type="submit" class="btn btn-success btn-sm float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="width: 100%;">
                @if ($barangay_logo)
                    <img class="img img-thumbnail" style="height:450px;"
                        src="{{ asset('/storage/' . $barangay_logo->logo) }}" alt="">
                @endif
            </div>
        </div>
    @endsection
