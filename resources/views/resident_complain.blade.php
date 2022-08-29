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
                <h6 class="card-header">Complain</h6>
                <div class="card-body">
                    <form action="{{ route('resident_complain_process') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="">Complainant:</label>
                                <input type="text" required name="complainant" class="form-control"
                                    value="{{ ucfirst($resident->first_name) }} {{ ucfirst($resident->middle_name) }} {{ ucfirst($resident->last_name) }}">
                            </div>
                            <div class="col-md-12">
                                <label for="">Respondent:</label>
                                <select name="respondent_id" id="respondent_id" class="form-control" required>
                                    <option value="" default>Select</option>
                                    @foreach ($respondent as $data)
                                        <option value="{{ $data->id }}">{{ ucfirst($data->first_name) }}
                                            {{ ucfirst($data->middle_name) }} {{ ucfirst($data->last_name) }} - Brgy 
                                            {{ $data->barangay->barangay }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="">Reason</label>
                                <textarea name="reason" class="form-control" require cols="30" rows="10"></textarea>
                            </div>
                            <div class="col-md-12">
                                <br />
                                <input type="hidden" name="resident_id" value="{{ $resident->id }}">
                                <input type="hidden" name="barangay_id" value="{{ $resident->barangay_id }}">
                                <button type="submit" class="btn btn-success btn-sm float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
