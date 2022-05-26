@extends('layouts.v_base')

@section('app_style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ URL::asset('theme/adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
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
                                <a type="button" onclick="addModal('{{route('motor-rent.add')}}')" class="btn btn-app">
                                    <span class="badge bg-success">Insert</span>
                                    <i class="fa fa-plus"></i> Add
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped data-tables">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Renter Name</th>
                                        <th>Renter ID</th>
                                        <th>Renter Phone</th>
                                        <th>Motorcycle</th>
                                        <th>Start Rent Date</th>
                                        <th>End Rent Date</th>
                                        <th>Duration</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Update By</th>
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

    @include('layouts.modals.v_add', ['route' => route('motor-rent.store')])

    @include('layouts.modals.v_edit', ['route' => route('motor-rent.update')])

    @include('layouts.modals.v_delete', ['route' => route('motor-rent.destroy')])

    @include('layouts.modals.v_detail')

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
    <script src="{{ URL::asset('js/custom/add.js') }}"></script>
    <script src="{{ URL::asset('js/custom/edit.js') }}"></script>
    <script src="{{ URL::asset('js/custom/delete.js') }}"></script>
    <script src="{{ URL::asset('js/custom/detail.js') }}"></script>

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
                // "responsive": true,
                // "autoWidth": false,
                "info": true,
                "paging": true,
                "scrollX": true,
                deferRender: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('motor-rent.datatables') }}',
                    method: 'POST',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "className": "text-center",width: '30px'},
                    {data: 'c_motor_rent_renter_name', name: 'c_motor_rent_renter_name', "className": "text-center", width: '130px'},
                    {data: 'c_motor_rent_renter_id', name: 'c_motor_rent_renter_id', "className": "text-center", width: '130px'},
                    {data: 'c_motor_rent_renter_phone', name: 'c_motor_rent_renter_phone', "className": "text-center", width: '130px'},
                    {data: 'c_motor_rent_motor', name: 'c_motor_rent_motor', "className": "text-center", width: '250px'},
                    {data: 'c_motor_rent_start_rent_date', name: 'c_motor_rent_start_rent_date', "className": "text-center", width: '130px'},
                    {data: 'c_motor_rent_end_rent_date', name: 'c_motor_rent_end_rent_date', "className": "text-center", width: '130px'},
                    {data: 'c_motor_rent_duration', name: 'c_motor_rent_duration', "className": "text-center", width: '130px'},
                    {data: 'c_motor_rent_total_price', name: 'c_motor_rent_total_price', "className": "text-center", width: '130px'},
                    {data: 'c_motor_rent_status', name: 'c_motor_rent_status', "className": "text-center", width: '120px'},
                    {data: 'c_motor_rent_update_by', name: 'c_motor_rent_update_by', "className": "text-center", width: '250px'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, "className": "text-center", width: '150px'}
                ],
            });
        });
    </script>
@endsection
