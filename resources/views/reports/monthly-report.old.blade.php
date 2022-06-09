@extends('layouts.app')

@section('icon_page', 'fas fa-teeth')

@section('title', 'Monthly Report')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title mt-1 mb-0 text-info"><i class="fas fa-filter"></i> Filter</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <form action="{{route('reports.monthly-report')}}" class="form-horizontal">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group date" id="duration_form" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#duration_form" 
                                                    name="duration_form" value="{{request('duration_form')}}" placeholder="Enter Form Date"/>
                                                <div class="input-group-append" data-target="#duration_form" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group date" id="duration_to" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#duration_to" 
                                                    name="duration_to" value="{{request('duration_to')}}" placeholder="Enter To Date"/>
                                                <div class="input-group-append" data-target="#duration_to" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" name="month">
                                                <option value="">Months</option>
                                                @foreach($months as $key => $item)
                                                    <option value="{{$key}}" 
                                                        {{request('month') == $key ? 'selected' : ''}}
                                                    >{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-control" name="financial_year">
                                                <option value="">Financial Year</option>
                                                @for ($i = date('Y'); $i >= date('Y')-20; $i--)
                                                    <option value="{{ $i }}" 
                                                        {{request('financial_year') == $i ? 'selected' : ''}}
                                                    >{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-info float-right form-control">
                                        <i class="fas fa-search"></i> 
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>

                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-header p-2">
                        <strong>Export As:</strong> 
                        <a type="button" href="#" class="btn btn-sm btn-success">
                            <i class="fas fa-file-excel"></i> Excel
                        </a>
                        <a type="button" href="#" class="btn btn-sm btn-danger">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                        <a type="button" href="#" class="btn btn-sm btn-info">
                            <i class="fas fa-file-image"></i> Image
                        </a>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-striped projects table-hover dataTable"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr>
                                                <th width="10%">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1"> All</label>
                                                    </div>
                                                </th>
                                                <th class="sorting">SL#</th>
                                                <th class="sorting">Name</th>
                                                <th class="sorting">Destination Form</th>
                                                <th class="sorting">Destination To</th>
                                                <th class="sorting">Cost</th>
                                                <th class="sorting">Date</th>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th width="10%">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1"> All</label>
                                                    </div>
                                                </th>
                                                <th class="sorting">SL#</th>
                                                <th class="sorting">Name</th>
                                                <th class="sorting">Destination Form</th>
                                                <th class="sorting">Destination To</th>
                                                <th class="sorting">Cost</th>
                                                <th class="sorting">Date</th>
                                        </tfoot>
                                        <tbody>
                                            @if (!empty($reports) && $reports->count() > 0)
                                                @foreach ($reports as $key => $item)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox">
                                                        </td>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->user }}</td>
                                                        <td>{{ $item->destination_from }}</td>
                                                        <td>{{ $item->destination_to }}</td>
                                                        <td>{{ $item->amount }}</td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($item->duration_form_date)->format('d F Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center text-danger font-weight-bold">No data
                                                        found!!</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if (!empty($reports) && $reports->count() > 0)
                            {{ $reports->links('vendor.pagination.custom') }}
                            @endif
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
    $(function () {
        $('#duration_form').datetimepicker({
            format: 'L'
        });
        $('#duration_to').datetimepicker({
            format: 'L'
        });
    })
</script>

@endsection

