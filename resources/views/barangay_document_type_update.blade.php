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
        <div class="row">
            <div class="col-md-8">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Document Type Update</div>
                    <div class="card-body">
                        <form action="{{ route('barangay_document_type_update_process') }}" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Document Name:</label>
                                        <input type="text" class="form-control"
                                            value="{{ $document_type->document_name }}" name="document_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Amount:</label>
                                        <input type="text" class="form-control" value="{{ $document_type->amount }}"
                                            name="amount" required>
                                    </div>
                                    <div class="col-md-12">
                                        <br />
                                        <input type="hidden" value="{{ $document_type->id }}" name="document_type_id">
                                        <button class="btn btn-sm btn-success float-right">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Document File Update</div>
                    <div class="card-body">
                        <form action="{{ route('barangay_document_type_update_file_process') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Template:</label>
                                        <input type="file" class="form-control" name="file" required>
                                    </div>
                                    <div class="col-md-12">
                                        <br />
                                        <input type="hidden" value="{{ $document_type->id }}" name="document_type_id">
                                        <button class="btn btn-sm btn-success float-right">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
