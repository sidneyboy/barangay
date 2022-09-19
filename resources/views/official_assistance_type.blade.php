@extends('layouts.official_layout')

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
            <h6 class="card-header">Assistance Type</h6>
            <div class="card-body">
                <form action="{{ route('official_assistance_type_process') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Title:</label>
                            <input type="text" class="form-control" required name="title">
                        </div>
                        <div class="col-md-12">
                            <br />
                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                            <input type="hidden" value="{{ $user->barangay_id }}" name="barangay_id">
                            <button type="submit" class="btn btn-sm btn-success float-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="table table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Added By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($type as $data)
                                <tr>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->user->first_name }} {{ $data->user->last_name }}</td>
                                    <td>{{ date('F j, Y', strtotime($data->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
