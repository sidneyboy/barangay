<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Document Report</title>
</head>

<body>
    <br />
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th colspan="6">Document Request</th>
            </tr>
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script>
        window.print();
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
