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

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 100%;">
                <h6 class="card-header">Complain Request</h6>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Complain No</th>
                                    <th>Complainant</th>
                                    <th>Respondent</th>
                                    <th>Reason</th>
                                    <th>Lupon</th>
                                    <th>Hearing Date</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complain as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ Str::ucfirst($data->complainant->first_name) }}
                                            {{ Str::ucfirst($data->complainant->middle_name) }}
                                            {{ Str::ucfirst($data->complainant->last_name) }}</td>
                                        <td>{{ Str::ucfirst($data->respondent->first_name) }}
                                            {{ Str::ucfirst($data->respondent->middle_name) }}
                                            {{ Str::ucfirst($data->respondent->last_name) }} - Brgy
                                            {{ Str::ucfirst($data->respondent->barangay->barangay) }}</td>
                                        <td>{{ $data->reason }}</td>
                                        <td>{{ $data->lupon_id }}</td>
                                        <td>{{ $data->hearing_date }}</td>
                                        <td>{{ $data->image }}</td>
                                        <td>{{ $data->status }}</td>
                                     
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
