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
        @foreach ($officials as $data)
            <div class="col-md-4" style="margin-bottom:10px;">
                <div class="card" style="width: 100%;">
                    <img src="{{ asset('storage/' . $data->user_image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $data->first_name }} {{ $data->middle_name }} {{ $data->last_anem }}</h5>
                        {{-- <p class="card-text">Position: {{ $data->position}}</p> --}}
                        <p class="card-text">Term: {{ $data->office_term }}</p>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                            data-target="#exampleModal{{ $data->id }}">
                            View Profile
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('barangay_official_update') }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="">First Name:</label>
                                                <input type="text" required name="first_name" class="form-control"
                                                    value="{{ $data->first_name }}">

                                                <label for="">Middle Name:</label>
                                                <input type="text" required name="middle_name" class="form-control"
                                                    value="{{ $data->middle_name }}">

                                                <label for="">Last Name:</label>
                                                <input type="text" required name="last_name" class="form-control"
                                                    value="{{ $data->last_name }}">

                                                <label for="">Gender:</label>
                                                <input type="text" required name="gender" class="form-control"
                                                    value="{{ $data->gender }}">

                                                <label for="">Civil Status:</label>
                                                <input type="text" required name="civil_status" class="form-control"
                                                    value="{{ $data->civil_status }}">

                                                <label for="">Birth Date:</label>
                                                <input type="text" required name="birth_date" class="form-control"
                                                    value="{{ $data->birth_date }}">

                                                <label for="">Contact Number:</label>
                                                <input type="text" required name="contact_number" class="form-control"
                                                    value="{{ $data->contact_number }}">

                                                <label for="">Spouse:</label>
                                                <input type="text" required name="spouse" class="form-control"
                                                    value="{{ $data->spouse }}">

                                                <label for="">Office Term:</label>
                                                <input type="text" required name="office_term" class="form-control"
                                                    value="{{ $data->office_term }}">

                                                <label for="">Position:</label>
                                                <select name="position_type_id" id="" class="form-control"
                                                    required>
                                                    {{-- <option value="{{ $data->position_type_id }}" selected>
                                                        {{ $data->position->title }}</option> --}}
                                                    @foreach ($position as $position_data)
                                                        <option value="{{ $position_data->id }}">
                                                            {{ $position_data->title }} Current</option>
                                                    @endforeach
                                                </select>

                                                <label for="">Email:</label>
                                                <input type="text" required name="email" class="form-control"
                                                    value="{{ $data->email }}">

                                                <input type="hidden" value="{{ $data->id }}" name="id">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="type" class="btn btn-success">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
