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
            <div class="card-header">Super User Registration</div>
            <div class="card-body">
                <form action="{{ route('super_user_registration_process') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-4">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" name="middle_name" required>
                        </div>
                        <div class="col-md-4">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                        <div class="col-md-3">
                            <label>User Type</label>
                            <select name="user_type" class="form-control" required>
                                <option value="" default>Select</option>
                                <option value="barangay_super_user">Super User</option>
                                <option value="barangay_validator">Barangay Validator</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="col-md-3">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                        <div class="col-md-12">
                            <br />
                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                            <button class="btn btn-sm btn-primary float-right" type="submit">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
