@extends('layouts.official_layout')

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
        <h6 class="card-header">Resident List</h6>
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Civil Status</th>
                            <th>Birth Date</th>
                            <th>Contact Number</th>
                            <th>Spouse</th>
                            <th>Mothers Name</th>
                            <th>Fathers Name</th>
                            <th>Email</th>
                            {{-- <th>Added By</th> --}}
                            <th>Photo</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resident as $data)
                            <tr>
                                <td>{{ $data->first_name }}</td>
                                <td>{{ $data->middle_name }}</td>
                                <td>{{ $data->last_name }}</td>
                                <td>{{ $data->gender }}</td>
                                <td>{{ $data->civil_status }}</td>
                                <td>{{ $data->birth_date }}</td>
                                <td>{{ $data->contact_number }}</td>
                                <td>{{ $data->spouse }}</td>
                                <td>{{ $data->mothers_name }}</td>
                                <td>{{ $data->fathers_name }}</td>
                                <td>{{ $data->email }}</td>
                                {{-- <td>{{ $data->barangay_official_id->first_name }}{{ $data->barangay_official_id->last_name }}
                                </td> --}}
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                        data-target="#exampleModal{{ $data->id }}">
                                        Photo
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ $data->first_name }}
                                                        {{ $data->middle_name }} {{ $data->last_name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card" style="width: 100%;">
                                                        <img class="card-img-top"
                                                            src="{{ asset('/storage/' . $data->user_image) }}"
                                                            alt="Card image cap">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal"
                                        data-target="#exampleModal_update{{ $data->id }}">
                                        Update
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal_update{{ $data->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Profile Update</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <form action="{{ route('official_res_profile_update') }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <label for="">First Name:</label>
                                                        <input type="text" required name="first_name"
                                                            class="form-control" value="{{ $data->first_name }}">

                                                        <label for="">Middle Name:</label>
                                                        <input type="text" required name="middle_name"
                                                            class="form-control" value="{{ $data->middle_name }}">

                                                        <label for="">Last Name:</label>
                                                        <input type="text" required name="last_name" class="form-control"
                                                            value="{{ $data->last_name }}">

                                                        <label for="">Gender:</label>
                                                        <select name="gender" class="form-control" required>
                                                            <option value="{{ $data->gender }}">{{ $data->gender }}
                                                                Current</option>
                                                            @if ($data->gender == 'Male')
                                                                <option value="Female">Female
                                                                </option>
                                                            @else
                                                                <option value="Male">Male
                                                                </option>
                                                            @endif
                                                        </select>

                                                        <label for="">Civil Status:</label>
                                                        <select name="civil_status" class="form-control" required>
                                                            <option value="{{ $data->civil_status }}">
                                                                {{ $data->civil_status }}
                                                                Current</option>
                                                            @if ($data->civil_status == 'Single')
                                                                <option value="Married">Married
                                                                </option>
                                                            @else
                                                                <option value="Single">Single
                                                                </option>
                                                            @endif
                                                        </select>

                                                        <label for="">Birth Date:</label>
                                                        <input type="text" required name="birth_date"
                                                            class="form-control" value="{{ $data->birth_date }}">

                                                        <label for="">Contact Number:</label>
                                                        <input type="text" required name="contact_number"
                                                            class="form-control" value="{{ $data->contact_number }}">

                                                        <label for="">Spouse:</label>
                                                        <input type="text" required name="spouse"
                                                            class="form-control" value="{{ $data->spouse }}">

                                                        <label for="">Mothers Name:</label>
                                                        <input type="text" required name="mothers_name"
                                                            class="form-control" value="{{ $data->mothers_name }}">

                                                        <label for="">Fathers Name:</label>
                                                        <input type="text" required name="fathers_name"
                                                            class="form-control" value="{{ $data->fathers_name }}">


                                                        <label for="">Email:</label>
                                                        <input type="text" required name="email"
                                                            class="form-control" value="{{ $data->email }}">

                                                        <input type="hidden" value="{{ $data->id }}"
                                                            name="resident_id">
                                                        <input type="hidden" value="{{ $user->id }}"
                                                            name="user_id">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
