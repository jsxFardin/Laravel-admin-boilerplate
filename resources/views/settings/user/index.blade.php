@extends('layouts.app')

@section('icon_page', 'fas fa-users')

@section('title', 'Employee')

@section('menu_pagina')
    @can('create-user', \App\Models\User::class)
        <li class="nav-item" user="presentation">
            <a href="{{ route('user.create') }}" class="nav-link link_menu_page">
                <i class="fa fa-plus"></i> Add
            </a>
        </li>
    @endcan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTables_length" id="datatable-user">
                                        <thead>
                                            <th class="sorting">SL#</th>
                                            <th class="sorting">Name</th>
                                            <th class="sorting">Email</th>
                                            <th class="sorting">Joining Date</th>
                                            <th class="sorting">Supervisor</th>
                                            <th class="sorting">Accommodation</th>
                                            <th class="sorting">Daily Allowance</th>
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
            $('#datatable-user').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                autoWidth: false,
                ajax: "{{ url('settings/user') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + 1
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'employee_detail',
                        name: 'employee_detail',
                        render: function(data, type, row, meta) {
                            return row.employee_detail && row.employee_detail.joining_date ?
                                row.employee_detail.joining_date : 'N/A';
                        }
                    },
                    {
                        data: 'employee_detail',
                        name: 'employee_detail',
                        render: function(data, type, row, meta) {
                            return row.employee_detail && row.employee_detail.supervisor ?
                                row.employee_detail.supervisor.name : 'N/A';
                        }
                    },
                    {
                        data: 'employee_detail',
                        name: 'employee_detail',
                        render: function(data, type, row, meta) {
                            return row.employee_detail && row.employee_detail.accommodation_cost ?
                                row.employee_detail.accommodation_cost : 'N/A';
                        }
                    },
                    {
                        data: 'employee_detail',
                        name: 'employee_detail',
                        render: function(data, type, row, meta) {
                            return row.employee_detail && row.employee_detail.daily_allowance_cost ?
                                row.employee_detail.daily_allowance_cost : 'N/A';
                        }
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
