@extends('layouts.app')

@section('icon_page', 'fas fa-map')

@section('title', 'Destination')

@section('menu_pagina')
    @can('create-destination', \App\Models\Destination::class)
        <li class="nav-item" role="presentation">
            <a href="{{ route('destination.create') }}" class="nav-link link_menu_page">
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
                                    <table class="table table-bordered dataTables_length" id="datatable-destination">
                                        <thead>
                                            <th>SL#</th>
                                            <th>Travel from</th>
                                            <th>Travel to</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            {{-- {{ $destinations->links('vendor.pagination.custom') }} --}}
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
    $(document).ready( function () {
        $('#datatable-destination').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            autoWidth: false,
            ajax: "{{ url('destination') }}",
            columns: [
                {
                    data: 'id', name: 'd.id',
                    render: function (data, type, row, meta) {
                        return meta.row + 1
                    }
                },
                {
                    data: 'travel_from', name: 'fl.name'
                },
                {   data: 'travel_to', name: 'tl.name' },
                {   data: 'amount', name: 'd.amount' },
                {
                    data: 'status', name: 'd.status',
                    render: function (data, type, row, meta) {
                        return `<span class="badge badge-${data == 1 ? 'success' : 'danger'}">${data == 1 ? 'Approved' : 'Pending'}</span>`
                    }
                },
                {   data: 'action', name: 'action', orderable: false},
            ],
            order: [[0, 'desc']]
        });
    })
</script>
@endsection
