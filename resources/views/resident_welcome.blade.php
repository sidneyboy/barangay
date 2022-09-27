@extends('layouts.resident_layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header" style="background-color:#008080;color:white;">FAQs</div>
        <div class="card-body">
            {{-- <div id="services" class="container">
                <div class="card" style="border-radius: 30px;">
                    <div class="card-body"> --}}
                        <center>
                            <h3>Our Services</h3>
                        </center>
                        <br />
                        <b>In this application you are able to do these actions</b> :<br />
                        <br />

                        <ul>
                            <li>Request documents</li>
                            <li>Request Assistance</li>
                            <li>Complain</li>
                            <li>Check your record of complaints
                            </li>
                            <li>Check your record of requested documents
                            </li>
                            <li> Check your record of requested assistance
                            </li>
                            <li>Modify your photo
                            </li>
                        </ul>
                    {{-- </div>
                </div>
            </div> --}}
            <br />
            {{-- <div id="reminder" class="container">
                <div class="card" style="border-radius: 30px;">
                    <div class="card-header">
                        <div class="card-body"> --}}
                            <center>
                                <h3>Reminder</h3>
                            </center>
                            <br />
                            Online transactions are made easier by providing each resident a credentials that will be use to
                            log
                            in. <br />
                            ​
                            <li>Make sure that you are registered to your barangay</li>
                            <li>Use active email address</li>
                            <li>Check email to know your credentials</li>
                            <li>Use your account gently</li>
                            <li>If you forget your password, check email.</li>
                        {{-- </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
