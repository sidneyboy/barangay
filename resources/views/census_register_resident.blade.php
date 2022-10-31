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

    <div class="container-fluid">
        <div class="card" style="width: 100%;">
            <h6 class="card-header">Resident Registration</h6>
            <div class="card-body">
                <form action="{{ route('offical_resident_registration_process') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <img id="blah" class="img img-thumbnail" src="{{ asset('storage/default_image.jpg') }}"
                                    alt="your image" />

                                <input type="file" min="0" required
                                    class="form-control form-control-user  @error('user_image') is-invalid @enderror"
                                    name="user_image" value="{{ old('user_image') }}" autofocus accept="image/*"
                                    id="imgInp" />



                                @error('user_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">{{ __('First Name:') }}</label>
                                <input id="first_name" type="text" required
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middle_name">{{ __('Middle Name:') }}</label>
                                <input id="middle_name" type="text" required
                                    class="form-control @error('middle_name') is-invalid @enderror" name="middle_name"
                                    value="{{ old('middle_name') }}" autocomplete="middle_name" autofocus>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name">{{ __('Last Name:') }}</label>
                                <input id="last_name" type="text" required
                                    class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    value="{{ old('last_name') }}" autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            Present Address
                            <input type="text" class="form-control" placeholder="(House/Block/Lot No.)"
                                name="present_house_block" required>
                        </div>
                        <div class="col-md-12">
                            <br />
                            <input type="text" class="form-control" placeholder="(St./Purok/Sitio/Subd.)"
                                name="present_subd" required>
                        </div>
                        <div class="col-md-12">
                            <br />
                            <input type="text" class="form-control" placeholder="(City/Munipality)"
                                name="present_municipality" required>
                        </div>
                        <div class="col-md-4">
                            <br />
                            <input type="text" class="form-control" placeholder="(Province)" name="present_province"
                                required>
                        </div>
                        <div class="col-md-4">
                            <br />
                            <select name="present_living_status" required class="form-control">
                                <option value="" default>Select Living Status</option>
                                <option value="owner">owner</option>
                                <option value="border">border</option>
                                <option value="rentee">rentee</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <br />
                            <input type="text" class="form-control" name="present_length_of_stay"
                                placeholder="Length of stay">
                        </div>

                        <div class="col-md-12">
                            Provincial Address
                            <input type="text" class="form-control" placeholder="(House/Block/Lot No.)"
                                name="provincial_house_block" required>
                        </div>
                        <div class="col-md-12">
                            <br />
                            <input type="text" class="form-control" placeholder="(St./Purok/Sitio/Subd.)"
                                name="provincial_subd" required>
                        </div>
                        <div class="col-md-12">
                            <br />
                            <input type="text" class="form-control" placeholder="(City/Munipality)"
                                name="provincial_municipality" required>
                        </div>
                        <div class="col-md-12">
                            <br />
                            <input type="text" class="form-control" placeholder="(Province)"
                                name="provincial_province" required>
                        </div>



















































































                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">{{ __('Sex:') }}</label>
                                <select name="gender" id="gender" required class="form-control">
                                    <option value="" default>Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="civil_status">{{ __('Civil Status:') }}</label>
                                <select name="civil_status" id="civil_status" required class="form-control">
                                    <option value="" default>Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widow">Widow</option>
                                    <option value="Separated">Separated</option>

                                </select>

                                @error('civil_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="weight">{{ __('Weight:') }}</label>
                                <input type="text" class="form-control" name="weight" required>

                                @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="height">{{ __('Height:') }}</label>
                                <input type="text" class="form-control" name="height" required>

                                @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="birth_date">{{ __('Date of Birth:') }}</label>
                                <input id="birth_date" type="date" required
                                    class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                                    value="{{ old('birth_date') }}" autocomplete="birth_date" autofocus>

                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="place_of_birth">{{ __('place of Birth:') }}</label>
                                <input id="place_of_birth" type="text" required
                                    class="form-control @error('place_of_birth') is-invalid @enderror"
                                    name="place_of_birth" value="{{ old('place_of_birth') }}"
                                    autocomplete="place_of_birth" autofocus>

                                @error('place_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="contact_number">{{ __('Contact Number:') }}</label>
                                <input id="contact_number" type="text" required
                                    class="form-control @error('contact_number') is-invalid @enderror"
                                    name="contact_number" value="{{ old('contact_number') }}"
                                    autocomplete="contact_number" autofocus>

                                @error('contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="religion">{{ __('Religion:') }}</label>
                                <input id="religion" type="text" required
                                    class="form-control @error('religion') is-invalid @enderror" name="religion"
                                    value="{{ old('religion') }}" autocomplete="religion" autofocus>

                                @error('religion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="spouse">{{ __('Spouse Name:') }}</label>
                                <input id="spouse" type="text" required
                                    class="form-control @error('spouse') is-invalid @enderror" name="spouse"
                                    value="{{ old('spouse') }}" autocomplete="spouse" autofocus>

                                @error('spouse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mothers_name">{{ __('Mothers Name:') }}</label>
                                <input id="mothers_name" type="text" required
                                    class="form-control @error('mothers_name') is-invalid @enderror" name="mothers_name"
                                    value="{{ old('mothers_name') }}" autocomplete="mothers_name" autofocus>

                                @error('mothers_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fathers_name">{{ __('Fathers Name:') }}</label>
                                <input id="fathers_name" type="text" required
                                    class="form-control @error('fathers_name') is-invalid @enderror" name="fathers_name"
                                    value="{{ old('fathers_name') }}" autocomplete="fathers_name" autofocus>

                                @error('fathers_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="current_address">{{ __('Current Addresss:') }}</label>
                                <input id="current_address" type="text" required
                                    class="form-control @error('current_address') is-invalid @enderror"
                                    name="current_address" value="{{ old('current_address') }}"
                                    autocomplete="current_address" autofocus>

                                @error('current_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="permanent_address">{{ __('Permanent_address:') }}</label>
                                <input id="permanent_address" type="text" required
                                    class="form-control @error('permanent_address') is-invalid @enderror"
                                    name="permanent_address" value="{{ old('permanent_address') }}"
                                    autocomplete="permanent_address" autofocus>

                                @error('permanent_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">{{ __('Email:') }}</label>
                                <input id="email" type="text" required
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="zone">{{ __('Zone:') }}</label>
                                <input type="text" name="zone" class="form-control" required>

                                @error('zone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="voter">{{ __('Voter:') }}</label>
                                <select name="voter" id="voter" required class="form-control" required>
                                    <option value="" default>Select</option>
                                    <option value="Voter">Voter</option>
                                    <option value="None Voter">None Voter</option>
                                </select>

                                @error('voter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan="3" style="text-align: center;">EDUCATIONAL ATTAINMENT</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center;width:200px;">Level of Education</th>
                                            <th style="text-align: center;">School</th>
                                            <th style="text-align: center;">Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Elementary</th>
                                            <th><input type="text" class="form-control" name="elementary_school[]">
                                            </th>
                                            <th><input type="text" class="form-control" name="elementary_address[]">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Highschool</th>
                                            <th><input type="text" class="form-control" name="highschool_school[]">
                                            </th>
                                            <th><input type="text" class="form-control" name="highschool_address[]">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Vocational Course</th>
                                            <th><input type="text" class="form-control"
                                                    name="vocation_course_school[]"></th>
                                            <th><input type="text" class="form-control"
                                                    name="vocation_course_address[]"></th>
                                        </tr>
                                        <tr>
                                            <th>College/Course</th>
                                            <th><input type="text" class="form-control" name="college_school[]"></th>
                                            <th><input type="text" class="form-control" name="college_address[]"></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan="3" style="text-align: center;">EMPLOYMENT RECORD</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center;width:200px;">Duration</th>
                                            <th style="text-align: center;">Company</th>
                                            <th style="text-align: center;">Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th><input type="text" class="form-control" name="duration[]"></th>
                                            <th><input type="text" class="form-control" name="duration[]"></th>
                                            <th><input type="text" class="form-control" name="duration[]"></th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" class="form-control" name="company[]"></th>
                                            <th><input type="text" class="form-control" name="company[]"></th>
                                            <th><input type="text" class="form-control" name="company[]"></th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" class="form-control" name="address[]"></th>
                                            <th><input type="text" class="form-control" name="address[]"></th>
                                            <th><input type="text" class="form-control" name="address[]"></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan="3" style="text-align: center;">OTHER HOUSE OCCUPANTS</th>
                                        </tr>
                                        <tr>
                                            <th style="text-align: center;width:200px;">NAME</th>
                                            <th style="text-align: center;">Position</th>
                                            <th style="text-align: center;">Age</th>
                                            <th style="text-align: center;">Birth Date</th>
                                            <th style="text-align: center;">Civil Status</th>
                                            <th style="text-align: center;">Occupation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th><input type="text" class="form-control" name="house_hold_name[]"></th>
                                            <th><input type="text" class="form-control" name="house_hold_position[]">
                                            </th>
                                            <th><input type="text" class="form-control" name="house_hold_age[]"></th>
                                            <th><input type="date" class="form-control"
                                                    name="house_hold_birth_date[]"></th>
                                            <th>
                                                <select name="house_hold_birth_civil_status[]" class="form-control">
                                                    <option value="" default>
                                                        Select</option>

                                                    <option value="Single">Single
                                                    </option>
                                                    <option value="Married">Married
                                                    </option>
                                                    <option value="Widow">Widow
                                                    </option>
                                                    <option value="Divorced">Divorced
                                                    </option>
                                                </select>
                                            </th>
                                            <th><input type="text" class="form-control"
                                                    name="house_hold_birth_occupation[]"></th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" class="form-control" name="house_hold_name[]"></th>
                                            <th><input type="text" class="form-control" name="house_hold_position[]">
                                            </th>
                                            <th><input type="text" class="form-control" name="house_hold_age[]"></th>
                                            <th><input type="date" class="form-control"
                                                    name="house_hold_birth_date[]"></th>
                                            <th>
                                                <select name="house_hold_birth_civil_status[]" class="form-control">
                                                    <option value="" default>
                                                        Select</option>

                                                    <option value="Single">Single
                                                    </option>
                                                    <option value="Married">Married
                                                    </option>
                                                    <option value="Widow">Widow
                                                    </option>
                                                    <option value="Divorced">Divorced
                                                    </option>
                                                </select>
                                            </th>
                                            <th><input type="text" class="form-control"
                                                    name="house_hold_birth_occupation[]"></th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" class="form-control" name="house_hold_name[]"></th>
                                            <th><input type="text" class="form-control" name="house_hold_position[]">
                                            </th>
                                            <th><input type="text" class="form-control" name="house_hold_age[]"></th>
                                            <th><input type="date" class="form-control"
                                                    name="house_hold_birth_date[]"></th>
                                            <th>
                                                <select name="house_hold_birth_civil_status[]" class="form-control">
                                                    <option value="" default>
                                                        Select</option>

                                                    <option value="Single">Single
                                                    </option>
                                                    <option value="Married">Married
                                                    </option>
                                                    <option value="Widow">Widow
                                                    </option>
                                                    <option value="Divorced">Divorced
                                                    </option>
                                                </select>
                                            </th>
                                            <th><input type="text" class="form-control"
                                                    name="house_hold_birth_occupation[]"></th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" class="form-control" name="house_hold_name[]"></th>
                                            <th><input type="text" class="form-control" name="house_hold_position[]">
                                            </th>
                                            <th><input type="text" class="form-control" name="house_hold_age[]"></th>
                                            <th><input type="date" class="form-control"
                                                    name="house_hold_birth_date[]"></th>
                                            <th>
                                                <select name="house_hold_birth_civil_status[]" class="form-control">
                                                    <option value="" default>
                                                        Select</option>

                                                    <option value="Single">Single
                                                    </option>
                                                    <option value="Married">Married
                                                    </option>
                                                    <option value="Widow">Widow
                                                    </option>
                                                    <option value="Divorced">Divorced
                                                    </option>
                                                </select>
                                            </th>
                                            <th><input type="text" class="form-control"
                                                    name="house_hold_birth_occupation[]"></th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" class="form-control" name="house_hold_name[]"></th>
                                            <th><input type="text" class="form-control" name="house_hold_position[]">
                                            </th>
                                            <th><input type="text" class="form-control" name="house_hold_age[]"></th>
                                            <th><input type="date" class="form-control"
                                                    name="house_hold_birth_date[]"></th>
                                            <th>
                                                <select name="house_hold_birth_civil_status[]" class="form-control">
                                                    <option value="" default>
                                                        Select</option>

                                                    <option value="Single">Single
                                                    </option>
                                                    <option value="Married">Married
                                                    </option>
                                                    <option value="Widow">Widow
                                                    </option>
                                                    <option value="Divorced">Divorced
                                                    </option>
                                                </select>
                                            </th>
                                            <th><input type="text" class="form-control"
                                                    name="house_hold_birth_occupation[]"></th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" class="form-control" name="house_hold_name[]"></th>
                                            <th><input type="text" class="form-control" name="house_hold_position[]">
                                            </th>
                                            <th><input type="text" class="form-control" name="house_hold_age[]"></th>
                                            <th><input type="date" class="form-control"
                                                    name="house_hold_birth_date[]"></th>
                                            <th>
                                                <select name="house_hold_birth_civil_status[]" class="form-control">
                                                    <option value="" default>
                                                        Select</option>

                                                    <option value="Single">Single
                                                    </option>
                                                    <option value="Married">Married
                                                    </option>
                                                    <option value="Widow">Widow
                                                    </option>
                                                    <option value="Divorced">Divorced
                                                    </option>
                                                </select>
                                            </th>
                                            <th><input type="text" class="form-control"
                                                    name="house_hold_birth_occupation[]"></th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" class="form-control" name="house_hold_name[]"></th>
                                            <th><input type="text" class="form-control" name="house_hold_position[]">
                                            </th>
                                            <th><input type="text" class="form-control" name="house_hold_age[]"></th>
                                            <th><input type="date" class="form-control"
                                                    name="house_hold_birth_date[]"></th>
                                            <th>
                                                <select name="house_hold_birth_civil_status[]" class="form-control">
                                                    <option value="" default>
                                                        Select</option>

                                                    <option value="Single">Single
                                                    </option>
                                                    <option value="Married">Married
                                                    </option>
                                                    <option value="Widow">Widow
                                                    </option>
                                                    <option value="Divorced">Divorced
                                                    </option>
                                                </select>
                                            </th>
                                            <th><input type="text" class="form-control"
                                                    name="house_hold_birth_occupation[]"></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" value="{{ $user->id }}" name="user_id">
                                <input type="hidden" value="{{ $user->barangay_id }}" name="barangay_id">
                                <br />
                                <button type="submit" class="btn btn-sm btn-success float-right">Submit</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $("#civil_status").change(function() {
            if ($(this).val() == 'Single') {
                $('#spouse').val('na');
            } else {
                $('#spouse').val('');
            }
        });
    </script>
@endsection
