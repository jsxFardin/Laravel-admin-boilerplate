@extends('layouts.app')

@section('icon_page', 'fas fa-check')

@section('title', 'Approve Expense')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-12">
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
            <div class="col-md-4 col-sm-6 col-12">
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
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Employee</span>
                        <span class="info-box-number">500</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTables_length"
                                        id="datatable-expense-approve-list">
                                        <thead>
                                            <th class="sorting">SL#</th>
                                            <th class="sorting">Expense Type</th>
                                            <th class="sorting">Description</th>
                                            <th class="sorting">Map</th>
                                            <th class="sorting">Amount</th>
                                            <th class="sorting text-center">Status</th>
                                            <th class="sorting">Created By</th>
                                            <th class="text-center">Action</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->
    </div>
@endsection

@section('page_scripts')
    <script>
        $(document).ready(function() {
            $('#datatable-expense-approve-list').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                autoWidth: false,
                ajax: "{{ url('expense/approve-list') }}",
                columns: [{
                        data: 'id',
                        name: 'e.id',
                        render: function(data, type, row, meta) {
                            return meta.row + 1
                        }
                    },
                    {
                        data: 'expense_type',
                        name: 'e.id',
                        render: function(data, type, row, meta) {
                            return `${row.expense_type} <br><span class="small">${row.time_duration}</span>`
                        }
                    },
                    {
                        data: 'description',
                        name: 'e.description'
                    },
                    {
                        data: 'destination',
                        name: 'fl.name'
                    },
                    {
                        data: 'expense_amount',
                        name: 'e.amount'
                    },
                    {
                        data: 'expense_status',
                        name: 'e.status',
                        render: function(data, type, row, meta) {
                            return `<span class="badge badge-${data == 1 ? 'success' : 'danger'}">${data == 1 ? 'Approved' : 'Pending'}</span>`
                        }
                    },
                    {
                        data: 'created_by',
                        name: 'u.name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ]
            });
        })
    </script>
@endsection
