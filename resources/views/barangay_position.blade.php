@extends('layouts.barangay_layout')

@section('content')
    <div class="card" style="width: 100%;">
        <h6 class="card-header">Position Type</h6>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('barangay_position_process') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input id="title" type="title" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}" autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">{{ __('description') }}</label>
                            <input id="description" type="description"
                                class="form-control @error('description') is-invalid @enderror" name="description"
                                value="{{ old('') }}" autocomplete="" autofocus>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success btn-sm float-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="table table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Position</th>
                            <th>Date Created</th>
                            <th>Update</th>
                            {{-- <th>Delete</th> --}}
                            {{-- <th>Enable/Disable</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($position as $data)
                            <tr>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->description }}</td>
                                <td> {{ date('F j, Y', strtotime($data->created_at)) }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm btn-block" data-toggle="modal"
                                        data-target="#exampleModal{{ $data->id }}">
                                        Update
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('barangay_position_update') }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Title:</label>
                                                            <input type="text" value="{{ $data->title }}" required
                                                                name="title" class="form-control">

                                                            <label for="">Description:</label>
                                                            <input type="text" value="{{ $data->description }}" required
                                                                name="description" class="form-control">
                                                            <input type="hidden" name="id"
                                                                value="{{ $data->id }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-sm">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                {{-- <td>
                                    <a href="{{ url('barangay_position_delete/' . $data->id) }}"
                                        class="btn btn-sm btn-danger btn-block">Delete</a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
