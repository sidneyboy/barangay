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
        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <h6 class="card-header">Document Request</h6>
                <div class="card-body">
                    <form action="{{ route('resident_document_request_process') }}" method="post">
                        @csrf
                        <div class="form-group">
                            @if ($complain_count != 0)
                                <center><h6 style="color:red;">There is a pending complain about you. You cannot request for a document</h6></center>
                            @else
                                <div class="col-md-12">
                                    <label>Document Type</label>
                                    <select name="document_type_id" class="form-control" required>
                                        <option value="" default>Select</option>
                                        @foreach ($document as $data)
                                            <option value="{{ $data->id }}">{{ $data->document_name }} -
                                                {{ number_format($data->amount, 2, '.', ',') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <br />
                                    <input type="hidden" name="resident_id" value="{{ $resident->id }}">
                                    <input type="hidden" name="barangay_id" value="{{ $resident->barangay_id }}">
                                    <button type="submit" class="btn btn-success btn-sm float-right">Submit</button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card" style="width: 100%;">
                <h6 class="card-header">Request List</h6>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Document</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($document_request as $data)
                                    <tr>
                                        <td>{{ $data->document->document_name }}</td>
                                        <td>{{ $data->document->document_name }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>{{ $data->reason }}</td>
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
