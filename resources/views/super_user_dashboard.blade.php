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
                            @if ($user->user_type == 'barangay_super_user')
                                <th>Message Barangay</th>
                            @else
                            @endif
                            @if ($user->user_type == 'barangay_validator')
                                <th>Option</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangay as $data)
                            <tr>
                                <td>{{ $data->barangay }}</td>
                                <td>
                                    @if ($data->status == 'Approved')
                                        Enabled
                                    @else
                                        Disabled
                                    @endif
                                </td>
                                <td>{{ date('F j, Y h:i a', strtotime($data->created_at)) }}</td>
                                @if ($user->user_type == 'barangay_super_user')
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                            data-target="#exampleModal{{ $data->id }}">
                                            Message
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Message Barangay
                                                            {{ $data->barangay }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('super_user_message_barangay') }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea name="message" class="form-control" required"></textarea>
                                                            <input type="hidden" value="{{ $data->id }}"
                                                                name="barangay_id">
                                                            <input type="hidden" value="{{ $user->id }}"
                                                                name="user_id">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-sm btn-primary">Send
                                                                Message</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endif
                                @if ($user->user_type == 'barangay_validator')
                                    <td>
                                        @if ($data->status == 'Pending Approval')
                                            <a href="{{ url('status_approval', [
                                                'user_id' => $user->id,
                                                'status' => 'Pending Approval',
                                                'barangay_id' => $data->id,
                                            ]) }}"
                                                class="btn btn-warning btn-block btn-sm">Disabled</a>
                                        @else
                                            <a href="{{ url('status_approval', [
                                                'user_id' => $user->id,
                                                'status' => 'Approved',
                                                'barangay_id' => $data->id,
                                            ]) }}"
                                                class="btn btn-success btn-block btn-sm">Enabled</a>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
