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
        <div class="col-md-12">
            <div class="card" style="width: 100%;">
                <div class="card-header">COMPANY NAME (ILISANAN PA NAMO SIR)</div>
                <div class="card-body">
                    @foreach ($message as $data)
                        <div class="card">
                            <div class="card-header">
                                {{ date('F j, Y', strtotime($data->created_at)) }}
                            </div>
                            <div class="card-body">
                                {{ $data->message }}
                            </div>
                        </div>
                        <br />
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
