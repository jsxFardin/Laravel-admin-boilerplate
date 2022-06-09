@extends('layouts.app')

@section('icon_page', 'fas fa-money-check-alt')

@section('title', 'Expense')

@section('menu_pagina')
    @can('create-expense', $expenses)
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
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-striped projects table-hover dataTable"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr>
                                                <th class="sorting">SL</th>
                                                <th class="sorting">Title</th>
                                                <th class="sorting">Map</th>
                                                <th class="sorting">Amount</th>
                                                <th class="sorting text-center">Status</th>
                                                <th class="text-center">Action</th>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="sorting">SL</th>
                                                <th class="sorting">Title</th>
                                                <th class="sorting">Map</th>
                                                <th class="sorting">Amount</th>
                                                <th class="sorting text-center">Status</th>
                                                <th class="text-center">Action</th>
                                        </thead>
                                        <tbody>
                                            @if($expenses->count() > 0)
                                                @foreach ($expenses as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                            {{ $item->title }} <br>
                                                            <span class="small">{{ $item->duration_to }} - {{ $item->duration_form }}</span>
                                                        </td>
                                                        <td> map </td>
                                                        <td>{{ $item->amount }}</td>
                                                        @if($item->status == 1)
                                                            <td class="text-center"><span class="badge badge-success">Approved</span></td>
                                                        @else
                                                            <td class="text-center"><span class="badge badge-danger">Pending</span></td>
                                                        @endif
                                                        <td class="text-center">
                                                            @can('approve-expense', $item)
                                                                <a href="#" class="btn btn-secondary btn-xs" title="Approve {{ $item->title }}"
                                                                    href="{{ route('expense.approve', [$item->id, $item->status]) }}" 
                                                                    data-toggle="modal" data-target="#approve-modal-{{$item->id}}">
                                                                    <i class="fas fa-check"></i>
                                                                </a>

                                                                @include('layouts.includes.approve_modal', 
                                                                    ['row' => $item, 'name' => $item->title, 
                                                                        'url' => 'expense/approve/'.$item->id.'/'.$item->status
                                                                    ]
                                                                )
                                                            @endcan
                                                            @can('print-expense', $item)
                                                                <a class="btn btn-info btn-xs" title="Print {{ $item->title }}"
                                                                    href="{{ route('expense.print', $item->id) }}">
                                                                    <i class="fas fa-print"></i>
                                                                </a>
                                                            @endcan
                                                            @can('download-expense', $item)
                                                                <a class="btn btn-success btn-xs" title="Download {{ $item->title }}"
                                                                    href="{{ route('expense.download', $item->id) }}">
                                                                    <i class="fas fa-download"></i>
                                                                </a>
                                                            @endcan
                                                            @can('edit-expense', $item)
                                                                <a class="btn btn-primary btn-xs" title="Update {{ $item->title }}"
                                                                    href="{{ route('expense.edit', $item->id) }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            @endcan
                                                            @can('delete-expense', $item)
                                                                <a href="#" class="btn btn-danger btn-xs" title="Delete {{ $item->title }}"
                                                                    data-toggle="modal" data-target="#delete-modal-{{$item->id}}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>

                                                                @include('layouts.includes.delete_modal', 
                                                                    ['row' => $item, 'name' => $item->title, 'url' => 'expense.destroy']
                                                                )
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                @include('layouts.includes.no-data-found')
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            {{ $expenses->links('vendor.pagination.custom') }}
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
