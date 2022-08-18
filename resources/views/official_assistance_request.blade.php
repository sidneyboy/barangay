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

    @foreach ($assistance as $data)
        <div class="row">
            <div class="card" style="width: 100%;margin-bottom:20px;">
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
                                Status: {{ $data->status }}
                            </span>
                        </div>
                    </div>
                </h6>
                <div class="card-body">
                    <h6 class="card-title">Requested By: {{ $data->resident->first_name }}
                        {{ $data->resident->middle_name }} {{ $data->resident->last_name }}</h6>
                    Assistance Type: {{ $data->assistance->title }}<br />
                    Brief Explanation: {{ $data->explanation }}
                </div>
                <div class="card-footer">
                    @if ($data->status != 'approved')
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
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                            <input type="number" name="approved_cash" class="form-control"
                                                                required>
                                                            <input type="hidden" name="approved_by_official_id"
                                                                value="{{ $user->id }}">
                                                            <input type="hidden" name="assistance_id"
                                                                value="{{ $data->id }}">
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
                    @endif
                    <span class="float-right">
                        {{ date('F j, Y', strtotime($data->created_at)) }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach
@endsection
