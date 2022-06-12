@extends('layouts.app')

@section('icon_page', 'fas fa-plus')

@section('title', 'Add Role')

@section('menu_pagina')
    <li class="nav-item" role="presentation">
        <a href="{{ route('role.index') }}" class="nav-link link_menu_page">
            <i class="fa fa-user-tag"></i> Role
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
                                        <label for="name">Name*</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" placeholder="Enter role name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="description">Description*</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" cols="50">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <h5 class="@error('permissions') text-danger @enderror">Permissions*</h5>
                                    @error('permissions')
                                        <span class="text-danger" style="font-size: 80%;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <ul class="list-group list-group-flush">

                                        @foreach ($permissions as $key => $value)
                                            <li class="list-group-item px-0">
                                                <a class="btn collapsed text-left w-100" data-toggle="collapse"
                                                    href="#collapseExample{{ $key }}" role="button"
                                                    aria-expanded="true" aria-controls="collapseExample{{ $key }}">
                                                    {{ $value->label }}<span class="mr-3"></span>
                                                </a>
                                                <div class="collapse" id="collapseExample{{ $key }}">
                                                    <div class="card card-body mt-2">
                                                        <!-- checkbox -->
                                                        <div class="form-group clearfix">
                                                            <div
                                                                class="icheck-success d-inline mr-3 {{ $value->name }}-parent">
                                                                <input type="checkbox"
                                                                    id="checkboxSuccess{{ $key }}{{ $value->id }}"
                                                                    class="check-all"
                                                                    data-name="{{ $value->name }}">
                                                                <label
                                                                    for="checkboxSuccess{{ $key }}{{ $value->id }}">
                                                                    All
                                                                </label>
                                                            </div>
                                                            @foreach ($value->permissions as $smKey => $smValue)
                                                                <div class="icheck-success d-inline mr-3">
                                                                    <input type="checkbox"
                                                                        id="checkboxSuccess{{ $key }}{{ $smKey }}{{ $smValue->id }}"
                                                                        name="permissions[]" value="{{ $smValue->id }}"
                                                                        data-name="{{ $value->name }}"
                                                                        class="{{ $value->name }} single-checkbox">
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

@section('page_scripts')
    <script src="{{ asset('assets/js/role/role.js') }}"></script>
@endsection
