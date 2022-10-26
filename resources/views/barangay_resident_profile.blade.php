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
        <h6 class="card-header">Resident Registration</h6>
        <div class="card-body">
            <div class="table table-responsive">
                {{-- <table id="example" class="table table-striped table-bordered" style="width:100%"> --}}
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Show Additional Info</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Civil Status</th>
                            <th>Birth Date</th>
                            <th>Contact Number</th>
                            <th>Spouse</th>
                            <th>Mothers Name</th>
                            <th>Fathers Name</th>
                            <th>Email</th>
                            <th>Zone</th>
                            <th>House/Block</th>
                            <th>Subd</th>
                            <th>City/municipality</th>
                            <th>Province</th>
                            <th>Home Status</th>
                            <th>Lenght of stay</th>
                            <th>Province House Block</th>
                            <th>Province Subd</th>
                            <th>Province Municipality</th>
                            <th>Province</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>Voter</th>
                            <th>Status</th>
                            <th>Photo</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resident as $data)
                            <tr>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal_addition{{ $data->id }}">
                                        Show
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal_addition{{ $data->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Additional Information
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table table-responsive">
                                                        <div class="form-group">
                                                            <form action="{{ route('education_update') }}" method="post">
                                                                @csrf
                                                                <table class="table table-bordered table-hover table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="3" style="text-align: center;">
                                                                                EDUCATIONAL ATTAINMENT</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th style="text-align: center;width:200px;">
                                                                                Level of
                                                                                Education</th>
                                                                            <th style="text-align: center;">School</th>
                                                                            <th style="text-align: center;">Address</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($data->resident_education as $educ)
                                                                            <tr>
                                                                                <td>{{ $educ->level_of_education }}</td>
                                                                                <td>
                                                                                    <input type="hidden"
                                                                                        class="form-control" required
                                                                                        name="id[]"
                                                                                        value="{{ $educ->id }}">
                                                                                    <input type="text"
                                                                                        class="form-control" required
                                                                                        name="school[{{ $educ->id }}]"
                                                                                        value="{{ $educ->school }}">
                                                                                </td>
                                                                                <td><input type="text"
                                                                                        class="form-control" required
                                                                                        name="address[{{ $educ->id }}]"
                                                                                        value="{{ $educ->address }}"></td>
                                                                            </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <th colspan="3"><button
                                                                                    class="btn btn-sm btn-primary float-right">Save
                                                                                    Changes</button></th>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </form>
                                                        </div>


                                                        <div class="form-group">
                                                            <form action="{{ route('employment_update') }}" method="post">
                                                                @csrf
                                                                <table class="table table-bordered table-hover table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="3" style="text-align: center;">
                                                                                EMPLOYMENT RECORD</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th style="text-align: center;width:200px;">
                                                                                Duration
                                                                            </th>
                                                                            <th style="text-align: center;">Company</th>
                                                                            <th style="text-align: center;">Address</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($data->resident_employment as $emp)
                                                                            <tr>
                                                                                <td>
                                                                                    <input type="hidden" name="emp_id[]"
                                                                                        value="{{ $emp->id }}">
                                                                                    <input type="text"
                                                                                        class="form-control" required
                                                                                        name="duration[{{ $emp->id }}]"
                                                                                        value="{{ $emp->duration }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        class="form-control" required
                                                                                        name="company[{{ $emp->id }}]"
                                                                                        value="{{ $emp->company }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        class="form-control" required
                                                                                        name="address[{{ $emp->id }}]"
                                                                                        value="{{ $emp->address }}">
                                                                                </td>

                                                                            </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <th colspan="3"><button
                                                                                    class="btn btn-sm btn-primary float-right">Save
                                                                                    Changes</button></th>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </form>
                                                        </div>

                                                        <div class="form-group">
                                                            <form action="{{ route('house_update') }}" method="post">
                                                                @csrf
                                                                <table class="table table-bordered table-hover table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="3" style="text-align: center;">
                                                                                OTHER
                                                                                HOUSE OCCUPANTS</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th style="text-align: center;width:200px;">NAME
                                                                            </th>
                                                                            <th style="text-align: center;">Position</th>
                                                                            <th style="text-align: center;">Age</th>
                                                                            <th style="text-align: center;">Birth Date</th>
                                                                            <th style="text-align: center;">Civil Status
                                                                            </th>
                                                                            <th style="text-align: center;">Occupation</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($data->resident_household as $house)
                                                                            <tr>
                                                                                <td>
                                                                                    <input type="hidden" name="house_id[]"
                                                                                        value="{{ $house->id }}">
                                                                                    <input type="text"
                                                                                        class="form-control" 
                                                                                        name="name[{{ $house->id }}]"
                                                                                        value="{{ $house->name }}">

                                                                                </td>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        class="form-control" 
                                                                                        name="position[{{ $house->id }}]"
                                                                                        value="{{ $house->position }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        class="form-control" 
                                                                                        name="age[{{ $house->id }}]"
                                                                                        value="{{ $house->age }}">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="date"
                                                                                        class="form-control" 
                                                                                        name="birth_date[{{ $house->id }}]"
                                                                                        value="{{ $house->birth_date }}">
                                                                                </td>
                                                                                <td>
                                                                                    {{-- <input type="text" class="form-control" 
                                                                                    name="civil_status[{{ $house->id }}]"
                                                                                    value="{{ $house->civil_status }}">
                                                                                <select name="" id=""></select> --}}
                                                                                    <select
                                                                                        name="civil_status[{{ $house->id }}]"
                                                                                         class="form-control">
                                                                                        <option value="" default>
                                                                                            Select</option>
                                                                                        <option
                                                                                            value="{{ $house->civil_status }}"
                                                                                            selected>
                                                                                            {{ $house->civil_status }}
                                                                                        </option>
                                                                                        <option value="Single">Single
                                                                                        </option>
                                                                                        <option value="Married">Married
                                                                                        </option>
                                                                                        <option value="Widow">Widow
                                                                                        </option>
                                                                                        <option value="Divorced">Divorced
                                                                                        </option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        class="form-control" 
                                                                                        name="occupation[{{ $house->id }}]"
                                                                                        value="{{ $house->occupation }}">
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        <tr>
                                                                            <th colspan="6"><button
                                                                                    class="btn btn-sm btn-primary float-right">Save
                                                                                    Changes</button></th>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </form>
                                                        </div>
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
                                <td>{{ $data->first_name }}</td>
                                <td>{{ $data->middle_name }}</td>
                                <td>{{ $data->last_name }}</td>
                                <td>{{ $data->gender }}</td>
                                <td>{{ $data->height }}</td>
                                <td>{{ $data->weight }}</td>
                                <td>{{ $data->civil_status }}</td>
                                <td>{{ $data->birth_date }}</td>
                                <td>{{ $data->contact_number }}</td>
                                <td>{{ $data->spouse }}</td>
                                <td>{{ $data->mothers_name }}</td>
                                <td>{{ $data->fathers_name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    {{-- @if ($data->zone != null)
                                        {{ $data->res_zone->zone }}
                                    @endif --}}
                                    {{ $data->zone }}
                                </td>
                                <td>{{ $data->present_house_block }}</td>
                                <td>{{ $data->present_subd }}</td>
                                <td>{{ $data->present_municipality }}</td>
                                <td>{{ $data->present_province }}</td>
                                <td>{{ $data->present_living_status }}</td>
                                <td>{{ $data->present_length_of_stay }}</td>
                                <td>{{ $data->provincial_house_block }}</td>
                                <td>{{ $data->provincial_subd }}</td>
                                <td>{{ $data->provincial_municipality }}</td>
                                <td>{{ $data->provincial_province }}</td>
                                <td>{{ $data->weight }}</td>
                                <td>{{ $data->height }}</td>
                                <td>{{ $data->voter }}</td>
                                <td>{{ $data->status }}</td>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ $data->first_name }}
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
                                                        <input type="text" required name="last_name"
                                                            class="form-control" value="{{ $data->last_name }}">

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

                                                        <label for="">Voter:</label>
                                                        <select name="voter" class="form-control" required>
                                                            <option value="{{ $data->voter }}">
                                                                {{ $data->voter }}
                                                                Current</option>
                                                            @if ($data->voter == 'Voter')
                                                                <option value="Non Voter">Non Voter
                                                                </option>
                                                            @else
                                                                <option value="Voter">Voter
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

                                                        <label for="">Current Address:</label>
                                                        <input type="text" required name="current_address"
                                                            class="form-control" value="{{ $data->current_address }}">

                                                        <label for="">Permanent Address:</label>
                                                        <input type="text" required name="permanent_address"
                                                            class="form-control" value="{{ $data->permanent_address }}">

                                                        <label for="">Status:</label>
                                                        {{-- <input type="text" required name="status"
                                                            class="form-control" value="{{ $data->status }}"> --}}

                                                        <select name="status" class="form-control" required>
                                                            <option value="" default>Select</option>
                                                            <option value="{{ $data->status }}" selected>
                                                                {{ $data->status }}</option>
                                                            @if ($data->status == 'alive')
                                                                <option value="dead">dead</option>
                                                            @else
                                                                <option value="alive">alive</option>
                                                            @endif
                                                        </select>


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
