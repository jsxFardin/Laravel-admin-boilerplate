@extends('layouts.app')

@section('icon_page', 'fas fa-map')

@section('title', 'Destination')

@section('menu_pagina')
    @can('create-destination', $destinations)
        <li class="nav-item" role="presentation">
            <a href="{{ route('destination.create') }}" class="nav-link link_menu_page">
                <i class="fa fa-plus"></i> Add
            </a>
        </li>
    @endcan
@endsection

{{-- @php
dd($destinations);
@endphp --}}

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-striped projects table-hover dataTable"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <th class="sorting">SL</th>
                                            <th class="sorting">Travel to</th>
                                            <th class="sorting">Travel from</th>
                                            <th class="sorting">Amount</th>
                                            <th class="text-center">Action </th>
                                        </thead>
                                        <tfoot>
                                            <th class="sorting">SL</th>
                                            <th class="sorting">Travel to</th>
                                            <th class="sorting">Travel from</th>
                                            <th class="sorting">Amount</th>
                                            <th class="text-center">Action </th>
                                        </tfoot>
                                        <tbody>
                                            @if ($destinations->count() > 0)
                                                @foreach ($destinations as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->travel_to }}</td>
                                                        <td>{{ $item->travel_from }}</td>
                                                        <td>{{ $item->amount }}</td>
                                                        <td class="text-center">
                                                            @can('edit-destination', $item)
                                                                <a class="btn btn-primary btn-xs"
                                                                    title="Update {{ $item->name }}"
                                                                    href="{{ route('destination.edit', $item->id) }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            @endcan
                                                            @can('delete-destination', $item)
                                                                <a href="#" class="btn btn-danger btn-xs"
                                                                    title="Delete {{ $item->name }}" data-toggle="modal"
                                                                    data-target="#delete-modal-{{ $item->id }}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>

                                                                @include('layouts.includes.delete_modal', [
                                                                    'row' => $item,
                                                                    'name' => $item->travel_from . ' To ' . $item->travel_to,
                                                                    'url' => 'destination.destroy',
                                                                ])
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

                            {{ $destinations->links('vendor.pagination.custom') }}
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
