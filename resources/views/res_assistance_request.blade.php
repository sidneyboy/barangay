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
        <h6 class="card-header">Request Assistance List</h6>
        <div class="card-body">
            <div class="row">
                @foreach ($assistance as $data)
                    <div class="col-md-12" style="margin-bottom:20px;">
                        <div class="card" style="width: 100%;">
                            <h6 class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        Request No: {{ $data->id }}
                                    </div>
                                    <div class="col-md-4">
                                        Approved Amount: {{ $data->approved_cash }}
                                    </div>
                                    <div class="col-md-4">
                                        <span>
                                            Status: <span class="badge badge-success">{{ $data->status }}</span>
                                        </span>
                                    </div>
                                </div>
                            </h6>
                            <div class="card-body">
                                <b>Assitance Type:</b> {{ $data->assistance->title }}<br />
                                <b> Brief Explanation:</b> {{ $data->explanation }}
                            </div>
                            <div class="card-footer">
                                <span class="float-right">
                                    {{ date('F j, Y', strtotime($data->created_at)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
