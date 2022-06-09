@extends('layouts.app')

@section('icon_page', 'fas fa-edit')

@section('title', 'Edit Location')

@section('menu_pagina')
    <li class="nav-item" role="presentation">
        <a href="{{ route('location.index') }}" class="nav-link link_menu_page">
            <i class="fa fa-location-arrow"></i> Location
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <form method="POST" action="{{ route('location.update', $location->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" id="name" placeholder="Enter location name" value="{{ $location->name }}">
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
        </div>
    </div>
@endsection
