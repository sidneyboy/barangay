@extends('layouts.super_user_layout')

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
        <div class="card">
            <div class="card-header">User Logs</div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>User</td>
                            <td>Content</td>
                            <td>Date & Time</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user_logs as $data)
                            <tr>
                                <td>{{ $data->user->name }} {{ $data->user->middle_name }} {{ $data->user->last_name }}</td>
                                <td>{{ $data->content }}</td>
                                <td> {{ date('F j, Y h:i:s a', strtotime($data->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
