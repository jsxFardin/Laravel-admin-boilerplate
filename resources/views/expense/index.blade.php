@extends('layouts.app')

@section('icon_page', 'fas fa-money-check-alt')

@section('title', 'Expense')

@section('menu_pagina')
    @can('create-expense', \App\Models\Expense::class)
        <li class="nav-item" role="presentation">
            <a href="{{ route('expense.create') }}" class="nav-link link_menu_page">
                <i class="fa fa-plus"></i> Add
            </a>
        </li>
    @endcan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-money-bill"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Expense</span>
                        <span class="info-box-number">150</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-dollar-sign"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Expense Summation</span>
                        <span class="info-box-number">50000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-hotel"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Availbale Accommodation</span>
                        <span class="info-box-number">500</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-hand-holding-usd"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Daily Allowance</span>
                        <span class="info-box-number">100</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered dataTables_length" id="datatable-expense">
                        <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Expense</th>
                            <th>Map</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>


            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->
    </div>
@endsection

@section('page_scripts')
<script>
    $(document).ready( function () {
        $('#datatable-expense').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            autoWidth: false,
            ajax: "{{ url('expense') }}",
            columns: [
                {
                    data: 'id', name: 'e.id',
                    render: function (data, type, row, meta) {
                        return meta.row + 1
                    }
                },
                {
                    data: 'expense_type', name: 'e.id',
                    render: function (data, type, row, meta) {
                        return `${row.expense_type} <br><span class="small">${row.time_duration}</span>`
                    }
                },
                {
                    data: 'destination', name: 'fl.name'
                },
                {   data: 'expense_amount', name: 'e.amount' },
                {
                    data: 'expense_status', name: 'e.status',
                    render: function (data, type, row, meta) {
                        return `<span class="badge badge-${data == 1 ? 'success' : 'danger'}">${data == 1 ? 'Approved' : 'Pending'}</span>`
                    }
                },
                {   data: 'created_by', name: 'u.name' },
                {   data: 'action', name: 'action', orderable: false},
            ],
            order: [[0, 'desc']]
        });
    })
</script>
@endsection
