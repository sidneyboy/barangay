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
        <div class="card-body">
            <div class="card-header">
                Complains
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Total # of Complains</th>
                                <th>Pending</th>
                                <th>Approved</th>
                                <th>On Progress</th>
                                <th>Resolved</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $complain_count }}</td>
                                <td>{{ $pending_count }}</td>
                                <td>{{ $approved_count }}</td>
                                <td>{{ $progress_count }}</td>
                                <td>{{ $end_count }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="card-header">
                Documents
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Total # of Documents</th>
                                <th>New Request</th>
                                <th>Approved</th>
                                <th>Received</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $document_count }}</td>
                                <td>{{ $new_request_count }}</td>
                                <td>{{ $d_approved_count }}</td>
                                <td>{{ $received_count }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
