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
            <h6 class="card-header">Complain Report</h6>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Complainant</th>
                                <th>Respondent</th>
                                <th>Reason</th>
                                <th>Lupon</th>
                                <th>Hearing Date</th>
                                <th>Time</th>
                                <th>Document</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($complain_report as $data)
                                <tr>
                                    <td>{{ $data->complainant->first_name }} {{ $data->complainant->middle_name }}
                                        {{ $data->complainant->last_name }}</td>
                                    <td>{{ $data->respondent->first_name }} {{ $data->respondent->middle_name }}
                                        {{ $data->respondent->last_name }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                            data-target="#exampleModal{{ $data->id }}">
                                            Show Reason
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog " role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Reason</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p> {{ $data->reason }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-dismiss="modal">Close</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $data->lupon->first_name }} {{ $data->lupon->middle_name }}
                                        {{ $data->lupon->last_name }}</td>
                                    <td>{{ $data->hearing_date }}</td>
                                    <td>{{ $data->time }}</td>
                                    <td>
                                        @if ($data->image == '')
                                            No Document Available
                                        @else
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#exampleModal_image{{ $data->id }}">
                                                Show Document
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal_image{{ $data->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hearing Document</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset('/storage/'. $data->image) }}" class="img img-thumbnail" alt="">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $data->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
