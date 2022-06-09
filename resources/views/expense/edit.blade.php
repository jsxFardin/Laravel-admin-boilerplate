@extends('layouts.app')

@section('icon_page', 'fas fa-plus')

@section('title', 'Edit Expense')

@section('menu_pagina')
    <li class="nav-item" role="presentation">
        <a href="{{ route('expense.index') }}" class="nav-link link_menu_page">
            <i class="fa fa-money-check-alt"></i> Expense
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <form method="POST" action="{{ route('expense.update', $expense->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                        name="title" placeholder="Enter title" value="{{ $expense->title }}">
                                </div>
                                <div class="form-group col-6">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                        name="description" placeholder="Enter description"> {!! $expense->description !!} </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="duration_to">Duration To</label>
                                    <div class="input-group date" id="duration_to_date_time" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input @error('duration_to') is-invalid @enderror"
                                            data-target="#duration_to_date_time" name="duration_to" 
                                            placeholder="Enter Duration To Date & Time" value="{{ $expense->duration_to }}"/>

                                        <div class="input-group-append" data-target="#duration_to_date_time" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="duration_form">Duration Form</label>
                                    <div class="input-group date" id="duration_form_date_time" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input  @error('duration_form') is-invalid @enderror" 
                                            data-target="#duration_form_date_time" name="duration_form" 
                                            placeholder="Enter Duration Form Date & Time" value="{{ $expense->duration_form }}"/>

                                        <div class="input-group-append" data-target="#duration_form_date_time" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="travel_to">Travel To</label>
                                    <input type="text" class="form-control @error('travel_to') is-invalid @enderror" 
                                        name="travel_to" placeholder="Enter travel_to" value="{{ $expense->travel_to }}">
                                </div>
                                <div class="form-group col-6">
                                    <label for="travel_form">Travel Form</label>
                                    <input type="text" class="form-control @error('travel_form') is-invalid @enderror" 
                                        name="travel_form" placeholder="Enter travel_form"  value="{{ $expense->travel_form }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="amount">Amount</label>
                                    <input type="text" class="form-control @error('amount') is-invalid @enderror" 
                                        name="amount" id="amount" placeholder="Enter amount" value="{{ $expense->amount }}">
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
        </div>
    </div>
@endsection

@section('page_scripts')
    <script>
        //Date and time picker
        $('#duration_to_date_time').datetimepicker({ 
            icons: { time: 'far fa-clock' } ,
            format: 'YYYY-MM-DD hh:mm A',
        });
        $('#duration_form_date_time').datetimepicker({ 
            icons: { time: 'far fa-clock' },
            format: 'YYYY-MM-DD hh:mm A',
        });
    </script>
@endsection
