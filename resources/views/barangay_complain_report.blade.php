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
                <div class="card-header">Complain Report</div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-sm table-bordered">
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
                                    <th>Option</th>
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
                                        <td>{{ $data->lupon->first_name }} {{ $data->lupon->middle_name }} {{ $data->lupon->last_name }}</td>
                                        <td>{{ $data->hearing_date }}</td>
                                        <td>{{ $data->image }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>
                                           @if ($data->status != 'Approved')
                                                <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#exampleModal{{ $data->id }}">
                                            Option
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Scheduler</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('barangay_complain_approved') }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Date</label>
                                                                <input type="date" class="form-control"
                                                                    name="hearing_date" required>

                                                                <label>Time</label>
                                                                <select name="time" class="form-control" required>
                                                                  <option value="" default>Select</option>
                                                                  <option value="Morning">Morning</option>
                                                                  <option value="Afternoon">Afternoon</option>
                                                                </select>

                                                                <label for="">Lupon</label>
                                                                <select name="lupon_id" required class="form-control">
                                                                    <option value="" default>Select</option>
                                                                    @foreach ($lupon as $lupon_data)
                                                                        <option value="{{ $lupon_data->id ."-". $lupon_data->email }}">
                                                                            {{ $lupon_data->first_name }} {{ $lupon_data->middle_name }} {{ $lupon_data->last_name }}</option>
                                                                    @endforeach
                                                                </select>

                                                                <input type="hidden" name="complainant_id" value="{{ $data->complainant_id }}">
                                                                <input type="hidden" name="complainant_first_name" value="{{ $data->complainant->first_name }}">
                                                                <input type="hidden" name="complainant_middle_name" value="{{ $data->complainant->middle_name }}">
                                                                <input type="hidden" name="complainant_last_name" value="{{ $data->complainant->last_name }}">

                                                                <input type="hidden" name="respondent_id" value="{{ $data->respondent_id }}">
                                                                <input type="hidden" name="respondent_first_name" value="{{ $data->respondent->first_name }}">
                                                                <input type="hidden" name="respondent_middle_name" value="{{ $data->respondent->middle_name }}">
                                                                <input type="hidden" name="respondent_last_name" value="{{ $data->respondent->last_name }}">

                                                                <input type="hidden" name="complainant_email" value="{{ $data->complainant->email }}">
                                                                <input type="hidden" name="respondent_email" value="{{ $data->respondent->email }}">

                                                                <input type="hidden" name="barangay" value="{{ $user->barangay->barangay }}">

                                                                <input type="hidden" name="complain_id" value="{{ $data->id }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary btn-sm">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                           @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
