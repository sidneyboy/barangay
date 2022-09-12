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
        <div class="col-md-4" style="margin-bottom:20px;">
            <div class="card" style="background-color:orange">
                <div class="card-header">Total Population</div>
                <div class="card-body">
                    <center><h1>{{ $resident_count }}</h1></center>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:20px;">
            <div class="card" style="background-color:green">
                <div class="card-header">Total Male</div>
                <div class="card-body">
                    <center><h1>{{ $total_number_of_male }}</h1></center>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:20px;">
            <div class="card" style="background-color:yellowgreen">
                <div class="card-header">Total Female</div>
                <div class="card-body">
                    <center><h1>{{ $total_number_of_female }}</h1></center>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:20px;">
            <div class="card" style="background-color:blue">
                <div class="card-header">Total Voter</div>
                <div class="card-body">
                    <center><h1>{{ $total_voter }}</h1></center>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:20px;">
            <div class="card" style="background-color:bisque">
                <div class="card-header">Total None Voter</div>
                <div class="card-body">
                    <center><h1>{{ $total_none_voter }}</h1></center>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="card" style="width: 100%;" style="margin-bottom:30px;">
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
    </div> --}}
@endsection
