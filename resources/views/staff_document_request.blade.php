@extends('layouts.staff_layout')

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
                            <th>Purpose</th>
                            <th>Document Name</th>
                            <th>Document</th>
                            <th>Amount</th>
                            {{-- <th>status</th> --}}
                            <th>time_approved</th>
                            <th>time_received</th>
                            <th>option</th>
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
                                <td>{{ $data->reason }}</td>
                                <td>{{ $data->document->document_name }}</td>
                                {{-- <td><a href="{{ asset('/storage/' . $data->document->file) }}"
                                    download>{{ $data->document->file }}</td> --}}
                                <td>
                                    @if ($data->status == 'Received')
                                    <a href="{{ url('print_document',[
                                        'id' => $data->resident_id,
                                        'document_id' => $data->id,
                                    ]) }}">Print Document</a>
                                    @endif
                                </td>
                                <td>{{ number_format($data->document->amount, 2, '.', ',') }}</td>

                                </td>
                                {{-- <td>{{ $data->status }}</td> --}}
                                <td>
                                    @if ($data->time_approved != '')
                                        {{ date('F j, Y h:i:s a', strtotime($data->time_approved)) }}
                                    @endif
                                </td>
                                <td>
                                    @if ($data->time_received != '')
                                        {{ date('F j, Y h:i:s a', strtotime($data->time_received)) }}
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status == 'New Request')
                                        <a style="width:100px;"
                                            href="{{ url('staff_document_request_approved', [
                                                'document_request_id' => $data->id,
                                                'document_id' => $data->document_type_id,
                                                'resident_id' => $data->resident_id,
                                                'user_id' => $user->id,
                                            ]) }}"
                                            class="btn btn-sm btn-primary btn-block">Approved ?</a>
                                    @elseif($data->status == 'Received')
                                        Ready For Printing
                                    @else
                                        <button type="button" class="btn btn-success btn-sm" disabled>Ready for Payment at
                                            Finance</button>
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
