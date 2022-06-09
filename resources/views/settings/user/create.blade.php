@extends('layouts.app')

@section('icon_page', 'fas fa-plus')

@section('title', 'Add user')

@section('menu_pagina')
    <li class="nav-item" role="presentation">
        <a href="{{ route('user.index') }}" class="nav-link link_menu_page">
            <i class="fa fa-location-arrow"></i> Users
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
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="name" placeholder="Enter name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="select2bs4" multiple="multiple"
                                            data-placeholder="Select role" style="width: 100%;">
                                            @if ($roles->count() != 0)
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            @else 
                                                <option value="">No data found!</option>
                                            @endif
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="supervisor_id">Supervisor</label>
                                        <select class="form-control @error('supervisor_id') is-invalid @enderror" name="supervisor_id">
                                            @if ($users->count() != 0)
                                                <option value="">Select One</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            @else 
                                                <option value="">No data found!</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="branch_id">Branch</label>
                                        <select class="form-control @error('branch_id') is-invalid @enderror" name="branch_id">
                                            @if ($branches->count() != 0)
                                                @foreach($branches as $branch)
                                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                @endforeach
                                            @else 
                                                <option value="">No data found!</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="department_id">Department </label>
                                        <select class="form-control @error('department_id') is-invalid @enderror" name="department_id">
                                            @if ($departments->count() != 0)
                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach
                                            @else 
                                                <option value="">No data found!</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation_id">Designation </label>
                                        <select class="form-control @error('designation_id') is-invalid @enderror" name="designation_id">
                                            @if ($designations->count() != 0)
                                                @foreach($designations as $designation)
                                                    <option value="{{$designation->id}}">{{$designation->name}}</option>
                                                @endforeach
                                            @else 
                                                <option value="">No data found!</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                            name="mobile" id="mobile" placeholder="Enter mobile">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            name="address" id="address" placeholder="Enter address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group</label>
                                        <input type="text" class="form-control @error('blood_group') is-invalid @enderror"
                                            name="blood_group" id="blood_group" placeholder="Enter blood group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="joining_date">Joining Date</label>
                                        <input type="date" class="form-control @error('joining_date') is-invalid @enderror"
                                            name="joining_date" id="joining_date" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="accommodation_cost">Accommodation Cost</label>
                                        <input type="text" class="form-control @error('accommodation_cost') is-invalid @enderror"
                                            name="accommodation_cost" id="accommodation_cost" placeholder="Enter accommodation cost">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="daily_allowance_cost">Daily Allowance Cost</label>
                                        <input type="text" class="form-control @error('daily_allowance_cost') is-invalid @enderror"
                                            name="daily_allowance_cost" id="daily_allowance_cost" 
                                            placeholder="Enter daily allowance cost">
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
