@extends('layouts.staff_layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container">
        @foreach ($assistance as $data)
            <div class="row">
                <div class="card" style="width: 100%;margin-bottom:20px;">
                    <h6 class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                Request No: {{ $data->id }}
                            </div>
                            <div class="col-md-4">
                                Approved Amount: {{ number_format($data->approved_cash, 2, '.', ',') }}
                            </div>
                            <div class="col-md-4">
                                <span>
                                    Status: <span class="badge badge-success">{{ Str::ucfirst($data->status) }}</span>
                                </span>
                            </div>
                        </div>
                    </h6>
                    <div class="card-body">
                        <h6 class="card-title">Requested By: {{ $data->resident->first_name }}
                            {{ $data->resident->middle_name }} {{ $data->resident->last_name }}</h6>
                        Assistance Type: {{ $data->assistance->title }}<br />
                        Brief Explanation: {{ $data->explanation }}
                        <br /><br />

                        <img src="{{ asset('/storage/' . $data->image) }}" class="img img-thumbnail" alt="">
                    </div>
                    <div class="card-footer">
                        @if ($data->status == 'New Request')
                            <span class="float-left">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal{{ $data->id }}">
                                    option
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Approval</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('official_assistance_approved') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Approved Cash</label>
                                                                <input type="number" name="approved_cash"
                                                                    class="form-control" required>

                                                                <label>Reason</label>
                                                                <textarea name="reason" class="form-control" required></textarea>

                                                                <label for="">Status</label>
                                                                <select name="status" class="form-control" required>
                                                                    <option value="" default>Select</option>
                                                                    <option value="approved">approved</option>
                                                                    <option value="disapproved">disapproved</option>
                                                                </select>

                                                                <input type="hidden" name="approved_by_official_id"
                                                                    value="{{ $user->id }}">
                                                                <input type="hidden" name="assistance_id"
                                                                    value="{{ $data->id }}">

                                                                <input type="hidden" name="resident_email"
                                                                    value="{{ $data->resident->email }}">

                                                                <input type="hidden" name="first_name"
                                                                    value="{{ $data->resident->first_name }}">

                                                                <input type="hidden" name="middle_name"
                                                                    value="{{ $data->resident->middle_name }}">

                                                                <input type="hidden" name="last_name"
                                                                    value="{{ $data->resident->last_name }}">

                                                                <input type="hidden" name="barangay"
                                                                    value="{{ $data->barangay->barangay }}">

                                                                <input type="hidden" name="assistance_title"
                                                                    value="{{ $data->assistance->title }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </span>
                        @else
                            <span class="float-left">
                                Approved Date:{{ date('F j, Y', strtotime($data->approved_date)) }}
                            </span>
                        @endif
                        <span class="float-right">
                            Requested Date:{{ date('F j, Y', strtotime($data->created_at)) }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
