@extends('layouts.app')

@section('icon_page', 'fas fa-plus')

@section('title', 'Add Role')

@section('menu_pagina')
    <li class="nav-item" role="presentation">
        <a href="{{ route('role.index') }}" class="nav-link link_menu_page">
            <i class="fa fa-location-arrow"></i> Role
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ route('role.store') }}">
                        @csrf

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" placeholder="Enter role name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="level">Level</label>
                                        <input type="text" class="form-control @error('level') is-invalid @enderror"
                                            name="level" id="level" placeholder="Enter role level">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <h5>Permissions</h5>
                                </div>
                                <div class="col-md-12">
                                    <ul class="list-group list-group-flush">

                                        @foreach ($permissions as $key => $value)
                                            <li class="list-group-item px-0">
                                                <a class="btn collapsed text-left w-100" data-toggle="collapse"
                                                    href="#collapseExample{{ $key }}" role="button"
                                                    aria-expanded="true" aria-controls="collapseExample{{ $key }}">
                                                    {{ $value->name }}<span class="mr-3"></span>
                                                </a>
                                                <div class="collapse" id="collapseExample{{ $key }}">
                                                    <div class="card card-body mt-2">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-success d-inline mr-3">
                                                                <input type="checkbox"
                                                                    id="checkboxSuccess{{ $key }}{{ $value->id }}">
                                                                <label
                                                                    for="checkboxSuccess{{ $key }}{{ $value->id }}">
                                                                    All
                                                                </label>
                                                            </div>
                                                            @foreach ($value->permissions as $smKey => $smValue)
                                                                <div class="icheck-success d-inline mr-3">
                                                                    <input type="checkbox"
                                                                        id="checkboxSuccess{{ $key }}{{ $smKey }}{{ $smValue->id }}"
                                                                        value="{{ $smValue->name }}">
                                                                    <label
                                                                        for="checkboxSuccess{{ $key }}{{ $smKey }}{{ $smValue->id }}">
                                                                        {{ $smValue->label }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
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
