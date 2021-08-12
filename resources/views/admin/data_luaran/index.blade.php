@extends('layout.layout_admin')

@section('title', 'Data Luaran')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-1 content-header">
                <div class="col-sm-12">
                    <h1>Data Luaran</h1>
                </div>
            </div>

        </div>

        <!-- <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-3 col-md-3">
                    <a href="" class="btn btn-primary btn-md mb-3 btn-block"><i class="fas fa-plus"></i> Tambah Bidang</a>
                </div>
            </div>
            </div> -->

        <!--Content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#kategori" data-toggle="tab">Kategori</a></li>
                            <li class="nav-item"><a class="nav-link" href="#jenis" data-toggle="tab">Jenis</a></li>
                            <li class="nav-item"><a class="nav-link" href="#status" data-toggle="tab">Status</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            <!-- KATEGORI TAB -->
                            <div class="active tab-pane" id="kategori">
                                <div class="card-body">
                                    <a href="{{route('admin_data_luaran_kategori_insert')}}" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> {{__('id.insert')}} Kategori Luaran</a>
                                    <table id="example2" class="table table-bordered table-hover table-striped projects">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori Luaran</th>
                                                <th>Tipe</th>
                                                <th>{{__('id.option')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($kategori as $data)
                                            <tr>
                                                <td>
                                                    <h5>{{$loop->iteration}}</h5>
                                                </td>
                                                <td>
                                                    <h5>{{$data->kategori_luaran_label}}</h5>
                                                </td>
                                                <td>
                                                    <h5>{{$data->kategori_luaran_required}}</h5>
                                                </td>

                                                <td>
                                                    <form action="{{route('admin_data_luaran_kategori_destroy', $data->kategori_luaran_id)}}" method="POST" class="form-inline form-horizontal">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="card-body">
                                                            <a class="btn btn-primary btn-sm" href="{{route('admin_data_luaran_kategori_edit', $data->kategori_luaran_id)}}">
                                                                <i class="fas fa-pencil-alt">
                                                                </i>

                                                                {{__('id.edit')}}
                                                            </a>

                                                            <button class="btn btn-danger btn-sm btn-remove" type="submit">
                                                                <i class="fas fa-trash">
                                                                </i>

                                                                {{__('id.remove')}}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END KATEGORI TAB -->

                            <!-- JENIS TAB -->
                            <div class="tab-pane" id="jenis">
                                <div class="card-body">
                                    <a href="{{route('admin_data_luaran_jenis_insert')}}" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> {{__('id.insert')}} Jenis Luaran</a>
                                    <table id="example3" class="table table-bordered table-hover table-striped projects">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Jenis Luaran</th>
                                                <th>{{__('id.option')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($jenis as $data)
                                            <tr>
                                                <td>
                                                    <h5>{{$loop->iteration}}</h5>
                                                </td>
                                                <td>
                                                    <h5>{{$data->kategori_luaran_label}}</h5>
                                                </td>
                                                <td>
                                                    <h5>{{$data->jenis_luaran_label}}</h5>
                                                </td>

                                                <td>
                                                    <form action="{{route('admin_data_luaran_jenis_destroy', $data->jenis_luaran_id)}}" method="POST" class="form-inline form-horizontal">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="card-body">
                                                            <a class="btn btn-primary btn-sm" href="{{route('admin_data_luaran_jenis_edit', $data->jenis_luaran_id)}}">
                                                                <i class="fas fa-pencil-alt">
                                                                </i>

                                                                {{__('id.edit')}}
                                                            </a>

                                                            <button class="btn btn-danger btn-sm btn-remove" type="submit">
                                                                <i class="fas fa-trash">
                                                                </i>

                                                                {{__('id.remove')}}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END JENIS TAB -->

                            <!-- STATUS TAB -->
                            <div class="tab-pane" id="status">
                                <div class="card-body">
                                    <a href="{{route('admin_data_luaran_status_insert')}}" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> {{__('id.insert')}} Status Luaran</a>
                                    <table id="example4" class="table table-bordered table-hover table-striped projects">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Status Luaran</th>
                                                <th>{{__('id.option')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($status as $data)
                                            <tr>
                                                <td>
                                                    <h5>{{$loop->iteration}}</h5>
                                                </td>
                                                <td>
                                                    <h5>{{$data->kategori_luaran_label}}</h5>
                                                </td>
                                                <td>
                                                    <h5>{{$data->status_luaran_label}}</h5>
                                                </td>

                                                <td>
                                                    <form action="{{route('admin_data_luaran_status_destroy', $data->status_luaran_id)}}" method="POST" class="form-inline form-horizontal">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="card-body">
                                                            <a class="btn btn-primary btn-sm" href="{{route('admin_data_luaran_status_edit', $data->status_luaran_id)}}">
                                                                <i class="fas fa-pencil-alt">
                                                                </i>

                                                                {{__('id.edit')}}
                                                            </a>

                                                            <button class="btn btn-danger btn-sm btn-remove" type="submit">
                                                                <i class="fas fa-trash">
                                                                </i>

                                                                {{__('id.remove')}}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END STATUS TAB -->
                        </div>
                    </div>

                </div>

            </div>
        </section>
</div>
<!-- /.content -->


@endsection

@push('plugin')
<script>
    // --------------
    // Delete Button
    // --------------
    $('.btn-remove').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

<!-- DataTables  & Plugins -->
<script src="{{URL::asset('assets/js/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pagingType": "simple_numbers",
            "language": {
                "url": "{{URL::asset('assets/js/datatables/Indonesian.json')}}"
            },
        });
        $('#example3').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pagingType": "simple_numbers",
            "language": {
                "url": "{{URL::asset('assets/js/datatables/Indonesian.json')}}"
            },
        });
        $('#example4').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pagingType": "simple_numbers",
            "language": {
                "url": "{{URL::asset('assets/js/datatables/Indonesian.json')}}"
            },
        });
    });
</script>
@endpush 