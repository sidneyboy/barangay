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
            <div class="card-header">Barangay List</div>
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Barangay</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangay as $data)
                            <tr>
                                <td>{{ $data->barangay }}</td>
                                <td>{{ $data->status }}</td>
                                <td>{{ date('F j, Y h:i a', strtotime($data->created_at)) }}</td>
                                <td>
                                    @if ($data->status == 'Pending Approval')
                                        <a href="{{ url('status_approval', [
                                            'user_id' => $user->id,
                                            'status' => 'Pending Approval',
                                            'barangay_id' => $data->id,
                                        ]) }}"
                                            class="btn btn-warning btn-block btn-sm">Pending Approval</a>
                                    @else
                                        <a href="{{ url('status_approval', [
                                            'user_id' => $user->id,
                                            'status' => 'Approved',
                                            'barangay_id' => $data->id,
                                        ]) }}"
                                            class="btn btn-success btn-block btn-sm">Approved</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
