@extends('layouts.app')

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.css') }}">
@endsection

@section('icon_page', 'fas fa-edit')

@section('title', 'Edit Destonation')

@section('menu_pagina')
    <li class="nav-item" role="presentation">
        <a href="{{ route('destination.index') }}" class="nav-link link_menu_page">
            <i class="fa fa-map"></i> Destination
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ route('destination.update', $destination->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group ui-widget">
                                        <label for="travel_from">Travel from*</label>
                                        <input id="travel_from" name="travel_from"
                                            class="form-control @error('amount') is-invalid @enderror"
                                            placeholder="Enter travel from" value="{{ $destination->travel_from }}" />
                                        @error('travel_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group ui-widget">
                                        <label for="travel_to">Travel to*</label>
                                        <input id="travel_to" name="travel_to"
                                            class="form-control @error('amount') is-invalid @enderror"
                                            placeholder="Enter travel to" value="{{ $destination->travel_to }}" />
                                        @error('travel_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="amount">Amount*</label>
                                        <input type="text" class="form-control @error('amount') is-invalid @enderror"
                                            name="amount" placeholder="Enter amount" value="{{ $destination->amount }}">
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="amount">Remarks</label>
                                        <textarea class="form-control  @error('remarks') is-invalid @enderror" name="remarks" rows="3">{{ old('remarks') }}</textarea>
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
                                Update
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/autocomplete/autocomplete.js') }}"></script>
    <script>
        $(function() {
            const autocompleteRoute = "{{ route('location.autocomplete') }}";
            autocomplete('#travel_from', autocompleteRoute);
            autocomplete('#travel_to', autocompleteRoute);
        })
    </script>
@endsection
