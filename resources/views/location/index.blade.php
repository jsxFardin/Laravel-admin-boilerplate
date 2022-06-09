@extends('layouts.app')

@section('icon_page', 'fas fa-location-arrow')

@section('title', 'Location')

@section('menu_pagina')
    @can('create-location', $locations)
        <li class="nav-item" role="presentation">
            <a href="{{ route('location.create') }}" class="nav-link link_menu_page">
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
                                                <th class="sorting">Name</th>
                                                <th class="text-center">Action</th>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="sorting">SL</th>
                                                <th class="sorting">Name</th>
                                                <th class="text-center">Action</th>
                                        </tfoot>
                                        <tbody>
                                            @if($locations->count() > 0)
                                                @foreach ($locations as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td class="text-center">
                                                            @can('edit-location', $item)
                                                                <a class="btn btn-primary btn-xs" title="Update {{ $item->name}}"
                                                                    href="{{ route('location.edit', $item->id) }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            @endcan

                                                            @can('delete-location', $item)
                                                                <a href="#" class="btn btn-danger btn-xs" title="Delete {{ $item->name}}"
                                                                    data-toggle="modal" data-target="#delete-modal-{{$item->id}}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>

                                                                @include('layouts.includes.delete_modal', 
                                                                    ['row' => $item, 'name' => $item->name, 'url' => 'location.destroy']
                                                                )
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3" class="text-center text-danger font-weight-bold">No data found!!</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{ $locations->links('vendor.pagination.custom') }}
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
