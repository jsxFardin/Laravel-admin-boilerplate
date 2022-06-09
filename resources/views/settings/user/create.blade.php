@extends('layouts.app')

@section('icon_page', 'fas fa-plus')

@section('title', 'Add Employee')

@section('menu_pagina')
    <li class="nav-item" role="presentation">
        <a href="{{ route('user.index') }}" class="nav-link link_menu_page">
            <i class="fa fa-users"></i> Employee
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="name" placeholder="Enter name" value="{{ old('name') }}">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span> </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password <span class="text-danger">*</span> </label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password" placeholder="Enter password">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password <span class="text-danger">*</span>
                                        </label>
                                        <input type="password"
                                            class="form-control @error('confirm_password') is-invalid @enderror"
                                            name="confirm_password" id="confirm_password"
                                            placeholder="Enter confirm password">
                                        @error('confirm_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role <span class="text-danger">*</span> </label>
                                        <select class="select2bs4 @error('role_id') is-invalid @enderror"
                                            multiple="multiple" data-placeholder="Select role" style="width: 100%;"
                                            name="role_id[]" id="role_id">
                                            @if ($roles->count() != 0)
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ in_array($role->id, old('role_id') ?: []) ? 'selected' : '' }}>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">No data found!</option>
                                            @endif
                                        </select>
                                        @error('role_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supervisor_id">Supervisor</label>
                                        <select class="form-control" name="supervisor_id">
                                            @if ($users->count() != 0)
                                                <option value="">Select One</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ old('supervisor_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">No data found!</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_id">Branch <span class="text-danger">*</span> </label>
                                        <select class="form-control @error('branch_id') is-invalid @enderror"
                                            name="branch_id">
                                            @if ($branches->count() != 0)
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}"
                                                        {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                                        {{ $branch->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">No data found!</option>
                                            @endif
                                        </select>
                                        @error('branch_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="department_id">Department <span class="text-danger">*</span> </label>
                                        <select class="form-control @error('department_id') is-invalid @enderror"
                                            name="department_id">
                                            @if ($departments->count() != 0)
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                        {{ $department->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">No data found!</option>
                                            @endif
                                        </select>
                                        @error('department_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation_id">Designation <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control @error('designation_id') is-invalid @enderror"
                                            name="designation_id">
                                            @if ($designations->count() != 0)
                                                @foreach ($designations as $designation)
                                                    <option value="{{ $designation->id }}"
                                                        {{ old('designation_id') == $designation->id ? 'selected' : '' }}>
                                                        {{ $designation->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">No data found!</option>
                                            @endif
                                        </select>
                                        @error('designation_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                            name="mobile" id="mobile" placeholder="Enter mobile"
                                            value="{{ old('mobile') }}">
                                        @error('mobile')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" name="address" id="address"
                                            placeholder="Enter address" value="{{ old('address') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group <span class="text-danger">*</span> </label>
                                        <select class="form-control @error('blood_group') is-invalid @enderror"
                                            name="blood_group">
                                            @foreach ($bloodGroup as $bg)
                                                <option value="{{ $bg }}"
                                                    {{ old('blood_group') == $bg ? 'selected' : '' }}>
                                                    {{ $bg }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('blood_group')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="accommodation_cost">Accommodation Cost <span
                                                class="text-danger">*</span> </label>
                                        <input type="text"
                                            class="form-control @error('accommodation_cost') is-invalid @enderror"
                                            name="accommodation_cost" id="accommodation_cost"
                                            placeholder="Enter accommodation cost"
                                            value="{{ old('accommodation_cost') }}">
                                        @error('accommodation_cost')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="joining_date">Joining Date <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" class="form-control @error('joining_date') is-invalid @enderror"
                                            name="joining_date" id="joining_date" value="{{ old('joining_date') }}">
                                        @error('joining_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="daily_allowance_cost">Daily Allowance Cost <span
                                                class="text-danger">*</span> </label>
                                        <input type="text"
                                            class="form-control @error('daily_allowance_cost') is-invalid @enderror"
                                            name="daily_allowance_cost" id="daily_allowance_cost"
                                            placeholder="Enter daily allowance cost"
                                            value="{{ old('daily_allowance_cost') }}">
                                        @error('daily_allowance_cost')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="amount">Remarks</label>
                                        <textarea name="remarks" class="form-control @error('remarks') is-invalid @enderror" rows="3" cols="50">{{ old('remarks') }}</textarea>
                                        @error('remarks')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-info btn-sm">
                                <i class="fas fa-plus"></i>
                                Submit
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endsection
