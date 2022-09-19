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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Assistance Type</div>
                    <form action="{{ route('barangay_assistance_type_process') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <label for="">Assistance Type</label>
                            <input type="text" class="form-control" name="assistance_type" required>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-success float-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Assistance Type</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assistance as $data)
                            <tr>
                                <td>{{ $data->title }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="modal"
                                        data-target="#exampleModal{{ $data->id }}">
                                        Update
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('assistance_type_update') }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->title }}" required name="title">
                                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-sm btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br />

    </div>
@endsection
