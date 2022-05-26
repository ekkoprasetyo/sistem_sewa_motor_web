@extends('layouts.v_base')

@section('app_style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">{{ $title }}</li>
                            <li class="breadcrumb-item active">{{ $subtitle }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a type="button" onclick="retryalljobsModal('{{route('failed-jobs.retry-all')}}')" class="btn btn-app">
                                    <span class="badge bg-danger">All</span>
                                    <i class="fa fa-plus"></i> Retry Jobs
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped data-tables">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>UUID</th>
                                        <th>Connection</th>
                                        <th>Queue</th>
                                        <th>Payload</th>
                                        <th>Exception</th>
                                        <th>Failed at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layouts.modals.v_retry_job', ['route' => route('failed-jobs.retry')])

    @include('layouts.modals.v_retry_all_jobs', ['route' => route('failed-jobs.retry-all')])

@endsection

@section('app_js')
    <!-- Select2 -->
    <script src="{{ URL::asset('theme/adminlte3/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ URL::asset('theme/adminlte3/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('theme/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('theme/adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('theme/adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ URL::asset('theme/adminlte3/plugins/toastr/toastr.min.js') }}"></script>
    <!-- Custom -->
    <script src="{{ URL::asset('js/custom/retry-jobs.js') }}"></script>
    <script src="{{ URL::asset('js/custom/retry-all-jobs.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            let table = $('.data-tables').DataTable({
                searching: true,
                stateSave: true,
                stateDuration: 60 * 60,
                "responsive": true,
                "autoWidth": false,
                "info": true,
                "paging": true,
                "scrollX": true,
                deferRender: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('failed-jobs.datatables') }}',
                    method: 'POST'
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "text-center", width: '25px'},
                    {data: 'uuid', name: 'uuid', width: '50px'},
                    {data: 'connection', name: 'connection', width: '50px'},
                    {data: 'queue', name: 'queue', width: '50px'},
                    {data: 'payload', name: 'payload', width: '200px'},
                    {data: 'exception', name: 'exception', width: '200px'},
                    {data: 'failed_at', name: 'failed_at', "className": "text-center", width: '100px'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, "className": "text-center", width: '150px'}
                ],
            });
        });
    </script>
@endsection
