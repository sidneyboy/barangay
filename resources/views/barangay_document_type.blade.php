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
    <div class="container">
        <div class="card" style="width: 100%;">
            <div class="card-header">Document Type</div>
            <div class="card-body">
                <form action="{{ route('barangay_document_save') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Document Name:</label>
                                <input type="text" class="form-control" name="document_name" required>
                            </div>
                            <div class="col-md-6">
                                <label>Amount:</label>
                                <input type="text" class="form-control" name="amount" required>
                            </div>
                            {{-- <div class="col-md-4">
                                <label>Template:</label>
                                <input type="file" class="form-control" name="file" required>
                            </div> --}}
                            <div class="col-md-12">
                                <br />
                                <input type="hidden" value="{{ $user->barangay_id }}" name="barangay_id">
                                <button class="btn btn-sm btn-success float-right">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <br />
        <div class="card" style="width: 100%;">
            <div class="card-header">Documents</div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Amount</th>
                                {{-- <th>File</th> --}}
                                {{-- <th>Update</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($document as $data)
                                <tr>
                                    <td>{{ $data->document_name }}</td>
                                    <td>{{ number_format($data->amount, 2, '.', ',') }}</td>
                                    {{-- <td><a href="{{ asset('/storage/' . $data->file) }}" download>Open</td> --}}
                                    {{-- <td><a href="{{ url('barangay_document_type_update',$data->id) }}">Update</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
