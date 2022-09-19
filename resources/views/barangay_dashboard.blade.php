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

    <div class="row">
        <div class="col-md-4" style="margin-bottom:20px;">
            <div class="card" style="background-color:cadetblue">
                <div class="card-header">Total Population</div>
                <div class="card-body">
                    <center>
                        <h1 style="color:white">{{ $resident_count }}</h1>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:20px;">
            <div class="card" style="background-color:#8fdbc5">
                <div class="card-header">Total Male</div>
                <div class="card-body">
                    <center>
                        <h1 style="color:white">{{ $total_number_of_male }}</h1>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:20px;">
            <div class="card" style="background-color:#64ADC4">
                <div class="card-header">Total Female</div>
                <div class="card-body">
                    <center>
                        <h1 style="color:white">{{ $total_number_of_female }}</h1>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:20px;">
            <div class="card" style="background-color:#367096">
                <div class="card-header">Total Voter</div>
                <div class="card-body">
                    <center>
                        <h1 style="color:white">{{ $total_voter }}</h1>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom:20px;">
            <div class="card" style="background-color:#4887B7">
                <div class="card-header">Total None Voter</div>
                <div class="card-body">
                    <center>
                        <h1 style="color:white">{{ $total_none_voter }}</h1>
                    </center>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Document Request Data</div>
                <div class="card-body">
                    <canvas id="monthly_stages_chart" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Assistance Data</div>
                <div class="card-body">
                    <canvas id="monthly_assistance" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Complain Data</div>
                <div class="card-body">
                    <canvas id="monthly_complains" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    <br />
    
  
    


    

    <div></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js">
    </script>

    {{-- <div class="card" style="width: 100%;" style="margin-bottom:30px;">
        <div class="card-body">
            <div class="card-header">
                Complains
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Total # of Complains</th>
                                <th>Pending</th>
                                <th>Approved</th>
                                <th>On Progress</th>
                                <th>Resolved</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $complain_count }}</td>
                                <td>{{ $pending_count }}</td>
                                <td>{{ $approved_count }}</td>
                                <td>{{ $progress_count }}</td>
                                <td>{{ $end_count }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="card-header">
                Documents
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Total # of Documents</th>
                                <th>New Request</th>
                                <th>Approved</th>
                                <th>Received</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $document_count }}</td>
                                <td>{{ $new_request_count }}</td>
                                <td>{{ $d_approved_count }}</td>
                                <td>{{ $received_count }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    <script>
        const labels = {!! json_encode($labels) !!};
        const data_for_status = {!! json_encode($data) !!};

        const labels_assistance = {!! json_encode($labels_assistance) !!};
        const data_assistance = {!! json_encode($data_assistance) !!};

        const labels_complains = {!! json_encode($labels_complains) !!};
        const data_complains = {!! json_encode($data_complains) !!};

        var monthly_stage_label_complains = labels_complains;
        var monthly_stage_data_complains = data_complains;

        new Chart("monthly_complains", {
            type: "bar",
            data: {
                labels: monthly_stage_label_complains,
                datasets: [{
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(153, 102, 255)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                    ],
                    borderWidth: 1,
                    data: monthly_stage_data_complains
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: "Agent Performance For the Month of ",
                    }
                }
            }
        });

        var monthly_stage_label_assistance = labels_assistance;
        var monthly_stage_data_assistance = data_assistance;

        new Chart("monthly_assistance", {
            type: "bar",
            data: {
                labels: monthly_stage_label_assistance,
                datasets: [{
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(153, 102, 255)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                    ],
                    borderWidth: 1,
                    data: monthly_stage_data_assistance
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: "Agent Performance For the Month of ",
                    }
                }
            }
        });

        var monthly_stage_label = labels;
        var monthly_stage_data = data_for_status;

        new Chart("monthly_stages_chart", {
            type: "bar",
            data: {
                labels: monthly_stage_label,
                datasets: [{
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(153, 102, 255)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                    ],
                    borderWidth: 1,
                    data: monthly_stage_data
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                        text: "Agent Performance For the Month of ",
                    }
                }
            }
        });
    </script>
@endsection
