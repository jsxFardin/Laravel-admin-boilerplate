@extends('layouts.app')

@section('icon_page', 'fas fa-edit')

@section('title', 'Edit Employee')

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
            <div class="col-md-8">

                <div class="card">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PUT')


                        <input type="text" class="d-none" name="employee_details_id"
                            value="{{ $user->employeeDetail ? $user->employeeDetail->id : '' }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="name" placeholder="Enter name" value="{{ $user->name }}">
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
                                            name="email" id="email" placeholder="Enter email" value="{{ $user->email }}">
                                        @error('email')
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
                                                @foreach ($roles as $key => $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $role_user->contains('role_id', $role->id) ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
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
                                                @foreach ($users as $u)
                                                    <option value="{{ $u->id }}"
                                                        {{ ($user->employeeDetail ? $user->employeeDetail->supervisor_id : '') == $u->id ? 'selected' : '' }}>
                                                        {{ $u->name }} </option>
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
                                                        {{ ($user->employeeDetail && $user->employeeDetail->first()->branch
                                                            ? $user->employeeDetail->first()->branch->id
                                                            : '') == $branch->id
                                                            ? 'selected'
                                                            : '' }}>
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
                                                        {{ ($user->employeeDetail && $user->employeeDetail->first()->department
                                                            ? $user->employeeDetail->first()->department->id
                                                            : '') == $department->id
                                                            ? 'selected'
                                                            : '' }}>
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
                                                        {{ ($user->employeeDetail && $user->employeeDetail->first()->designation
                                                            ? $user->employeeDetail->first()->designation->id
                                                            : '') == $designation->id
                                                            ? 'selected'
                                                            : '' }}>
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
                                            value="{{ $user->employeeDetail ? $user->employeeDetail->mobile : '' }}">
                                        @error('mobile')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" name="address" id="address"
                                            placeholder="Enter address"
                                            value="{{ $user->employeeDetail ? $user->employeeDetail->address : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group <span class="text-danger">*</span> </label>
                                        <select class="form-control @error('blood_group') is-invalid @enderror"
                                            name="blood_group">
                                            @foreach ($bloodGroup as $bg)
                                                <option value="{{ $bg }}"
                                                    {{ ($user->employeeDetail ? $user->employeeDetail->blood_group : '') == $bg ? 'selected' : '' }}>
                                                    {{ $bg }}</option>
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
                                            value="{{ $user->employeeDetail ? $user->employeeDetail->accommodation_cost : '' }}">
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
                                            name="joining_date" id="joining_date"
                                            value="{{ $user->employeeDetail ? $user->employeeDetail->joining_date : '' }}">
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
                                            value="{{ $user->employeeDetail ? $user->employeeDetail->daily_allowance_cost : '' }}">
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
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                                Update
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="col-md-4">
                <div class="card">
                    <form method="POST" action="{{ route('user.change.password', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="old_password">Old Password <span class="text-danger">*</span>
                                        </label>
                                        <input type="password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            name="old_password" id="old_password" placeholder="Enter old password">
                                        @error('old_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="new_password">New Password <span class="text-danger">*</span>
                                        </label>
                                        <input type="password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            name="new_password" id="new_password" placeholder="Enter new password">
                                        @error('new_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="new_confirm_password">Confirm Password <span
                                                class="text-danger">*</span> </label>
                                        <input type="password"
                                            class="form-control @error('new_confirm_password') is-invalid @enderror"
                                            name="new_confirm_password" id="new_confirm_password"
                                            placeholder="Enter confirm password">
                                        @error('new_confirm_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                                Update Password
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
