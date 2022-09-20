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
    <div class="card" style="width: 100%;">
        <div class="card-header">Assistance Request</div>
        <div class="card-body">
            <div class="table table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Assistance Type</th>
                            <th>Resident</th>
                            <th>Purpose</th>
                            <th>Approved Cash</th>
                            <th>Status</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($record as $data)
                            <tr>
                                <td>{{ $data->assistance->title }}</td>
                                <td>{{ $data->resident->first_name }} {{ $data->resident->middle_name }} {{ $data->resident->last_name }}</td>
                                <td>{{ $data->explanation }}</td>
                                <td>{{ $data->approved_cash }}</td>
                                <td>{{ $data->status }}</td>
                                <td>{{ $data->reason }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <form action="{{ route('assistance_report_print') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        From: <input type="date" class="form-control" required name="date_from">
                    </div>
                    <div class="col-md-4">
                        To: <input type="date" class="form-control" required name="date_to">
                    </div>
                    <div class="col-md-4">
                        <br />
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-primary">Print Report</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
