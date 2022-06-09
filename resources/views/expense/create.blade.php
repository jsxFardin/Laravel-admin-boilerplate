@extends('layouts.app')

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.css') }}">
@endsection

@section('icon_page', 'fas fa-plus')

@section('title', 'Add Expense')

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
                <div class="card">
                    <form method="POST" action="{{ route('expense.store') }}" id="expenseForm">
                        @csrf

                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="title">Title</label>
                                    <select class="form-control @error('expense_type_id') is-invalid @enderror" 
                                        name="expense_type_id" onchange="expenseType()" id="expense_type_id">
                                        @foreach ($expenseType as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="description">Description*</label>
                                        <textarea class="form-control  @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="duration_form">Duration Form</label>
                                    <div class="input-group date" id="duration_form_date_time" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input  @error('duration_form') is-invalid @enderror" 
                                            data-target="#duration_form_date_time" name="duration_form" 
                                            placeholder="Enter Duration Form Date & Time" value="{{old('duration_form')}}"/>

                                        <div class="input-group-append" data-target="#duration_form_date_time" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="duration_to">Duration To</label>
                                    <div class="input-group date" id="duration_to_date_time" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input @error('duration_to') is-invalid @enderror"
                                            data-target="#duration_to_date_time" name="duration_to" 
                                            placeholder="Enter Duration To Date & Time" value="{{old('duration_to')}}"/>

                                        <div class="input-group-append" data-target="#duration_to_date_time" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row hide-row">
                                <div class="form-group col-6">
                                    <label for="travel_form">Travel Form</label>
                                    <input type="text" class="form-control @error('travel_form') is-invalid @enderror" 
                                        name="travel_form" id="travel_form" placeholder="Travel form" id="travel_form" 
                                        value="{{old('travel_form')}}">
                                    <small class="text-danger" id="travel_form_message"></small>
                                </div>
                                <div class="form-group col-6">
                                    <label for="travel_to">Travel To</label>
                                    <input type="text" class="form-control @error('travel_to') is-invalid @enderror" 
                                        name="travel_to" placeholder="Type travel place" id="travel_to" 
                                        value="{{old('travel_to')}}">
                                </div>
                            </div>
                            <div class="row hide-amount-row d-none">
                                <div class="form-group col-6">
                                    <label for="amount">Amount </label>
                                    <input type="text" class="form-control @error('amount') is-invalid @enderror" 
                                        name="amount" placeholder="Enter amount" id="amount"  value="{{old('amount')}}">
                                </div>
                            </div>

                            <div class="hide-row">
                                <div class="text-center" id="calculated_message">
                                    <h5 class="text-danger text-center text-bold"></h5>
                                </div>
                                <div class="d-flex justify-content-center mt-4" id="calculated_value">
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <h4 class="info-box-text text-center text-bold" >Estimated Cost</h4>
                                                <h4 class="info-box-number text-center text-bold mb-0 value" >0</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <input type="text" name="destination_id" id="destination_id" value="" class="d-none">
                            </div>
                        </div>
        
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="getAmount()">
                                <i class="fas fa-calculator"></i>
                                Calculate
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="resetForm()">
                                <i class="fas fa-retweet"></i>
                                <i class="fa-solid fa-arrow-rotate-right"></i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-info btn-sm">
                                <i class="fas fa-plus"></i>
                                Save this entry
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
        //Date and time picker
        $('#duration_to_date_time').datetimepicker({ 
            icons: { time: 'far fa-clock' } ,
            format: 'YYYY-MM-DD hh:mm A',
        });
        $('#duration_form_date_time').datetimepicker({ 
            icons: { time: 'far fa-clock' },
            format: 'YYYY-MM-DD hh:mm A',
        });

        // FOR AUTO COMPLETE
        $(function() {
            const autocompleteRoute = "{{ route('expense.autocomplete') }}";
            autocomplete('#travel_to', autocompleteRoute, {key: 'travel_to'});
            let travel_to_ = $('#travel_to').val()
            autocomplete('#travel_form', autocompleteRoute, {key: 'travel_form', travel_to_val: travel_to_});  
        })
        function getAmount() {
            let travel_to_   = $('#travel_to').val()
            let travel_form_ = $('#travel_form').val()
            
            if (travel_to_ == travel_form_) {
                $('#travel_form_message').text("Travel to and travel form can't be same!")
            }else {
                hideTravelFormMessage()
                $.ajax({
                    url: "{{ route('expense.autocomplete') }}",
                    dataType: "json",
                    data: {
                        travel_to: travel_to_,
                        travel_form: travel_form_,
                    },
                    success: function (data) {   
                        if (data && data.id) {
                            showCalculatedDiv()
                            $('#calculated_value').find('.value').text(data.amount ?? 0)
                            $('#amount').attr('value', data.amount ?? 0)
                            $('#destination_id').attr('value', data.id)
                            hideCalculatedMessage()
                        } else {
                            hideCalculatedDiv()
                            showCalculatedMessage()
                            removeInputValue()
                        }
                    },
                });
            }
        }
        function resetForm() {
            $('#expenseForm').trigger('reset')
            $('#travel_to').val("")
            $('#travel_form').val("")
            hideTravelFormMessage()
            hideCalculatedMessage()
            removeInputValue()
        }
        function expenseType() {
            removeInputValue()
            hideTravelFormMessage()
            let expense_type_ = $('#expense_type_id').val()
            if (expense_type_ == 4) { // FOR OTHERS OPTIONS
                $('.hide-row').addClass('d-none')
                $('.hide-amount-row').addClass('d-block')
                hideCalculatedDiv()
            } else if (expense_type_ == 1) { // FOR TRANSPORT ALLOWANCE
                $('.hide-amount-row').removeClass('d-block')
                $('.hide-row').removeClass('d-none')
                showCalculatedDiv()
            }else {
                $('.hide-row').removeClass('d-none')
                $('.hide-amount-row').addClass('d-block')
                hideCalculatedDiv()
            }
        }

        // SHOW AND HIDE FUNCTIONS
        function showCalculatedDiv() {
            $('#calculated_value').addClass('d-block d-flex')
        }
        function hideCalculatedDiv() {
            $('#calculated_value').removeClass('d-flex d-block')
            $('#calculated_value').addClass('d-none')
        }
        function showCalculatedMessage() {
            $('#calculated_message').addClass('d-block')
            $('#calculated_message').find('h5').text("No Data found!")
        }
        function hideCalculatedMessage() {
            $('#calculated_message').addClass('d-none')
            $('#calculated_message').find('h5').text("")
        }
        function hideTravelFormMessage() {
            $('#travel_form_message').text('')
        }
        function removeInputValue() {
            $('#calculated_value').find('.value').text('0')
            $('#amount').attr('value', '')
            $('#destination_id').attr('value', '')
        }
       
    </script>
@endsection