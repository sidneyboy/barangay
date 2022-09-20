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
    <div class="card" style="width: 100%;">
        <div class="card-header">Document Request</div>
        <div class="card-body">
            <div class="table table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Requester</th>
                            {{-- <th>Approved</th> --}}
                            <th>Document Name</th>
                            <th>Amount</th>
                            {{-- <th>Document</th> --}}
                            <th>status</th>
                            <th>time_approved</th>
                            <th>time_received</th>
                            {{-- <th>option</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($document_request as $data)
                            <tr>
                                <td>{{ $data->resident->first_name }} {{ $data->resident->middle_name }}
                                    {{ $data->resident->last_name }}</td>
                                {{-- <td>
                                    @if ($data->user_id != '')
                                        {{ $data->staff->name }}
                                    @else
                                    @endif
                                </td> --}}
                                <td>{{ $data->document->document_name }}</td>
                                <td>{{ number_format($data->document->amount, 2, '.', ',') }}</td>
                                {{-- <td><a href="{{ asset('/storage/' . $data->document->file) }}"
                                        download>{{ $data->document->file }}</td> --}}
                                <td>{{ $data->status }}</td>
                                <td>
                                    @if ($data->time_approved != '')
                                        {{ date('F j, Y h:i:s a', strtotime($data->time_approved)) }}
                                    @endif
                                </td>
                                {{-- <td>
                                    @if ($data->time_disapproved != '')
                                        {{ date('F j, Y h:i:s a', strtotime($data->time_disapproved)) }}
                                    @endif
                                </td> --}}
                                <td>
                                    @if ($data->time_received != '')
                                        {{ date('F j, Y h:i:s a', strtotime($data->time_received)) }}
                                    @endif
                                </td>
                                {{-- <td>{{ $user }}</td> --}}
                                {{-- <td>{{ $data->reason }}</td> --}}
                                {{-- <td>
                                    @if ($data->status == 'New Request')
                                        
                                        <a style="width:100px;"
                                            href="{{ url('barangay_document_request_approved', [
                                                'document_request_id' => $data->id,
                                                'document_id' => $data->document_type_id,
                                                'resident_id' => $data->resident_id,
                                                'user_id' => $user->id,
                                            ]) }}"
                                            class="btn btn-sm btn-primary btn-block">Approved ?</a>
                                    @elseif ($data->status == 'Approved')
                                        <a style="width:100px;"
                                            href="{{ url('barangay_document_request_received', [
                                                'document_request_id' => $data->id,
                                                'document_id' => $data->document_type_id,
                                                'resident_id' => $data->resident_id,
                                                'user_id' => $user->id,
                                            ]) }}"
                                            class="btn btn-sm btn-primary btn-block">Received ?</a>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm" disabled>Received</button>
                                    @endif
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <form action="{{ route('document_report_print') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        From: <input type="date" class="form-control" required name="date_from">
                    </div>
                    <div class="col-md-4">
                        To: <input type="date" class="form-control" required name="date_to">
                    </div>
                    <div class="col-md-4">
                        <br />
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-primary">Print Report</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
