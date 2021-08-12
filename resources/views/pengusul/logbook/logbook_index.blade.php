@extends('layout.layout_pengusul')

@section('title', 'Logbook')

@section('suspend_banner')
@include('layout.suspend_banner')
@endsection

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Logbook</h1>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-3 col-md-3">
                    <a href="{{route('pengusul_logbook_detail_insert', $penelitian_id)}}" class="btn btn-primary btn-md mb-3 btn-block"><i class="fas fa-plus"></i> Tambah Logbook</a>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('pengusul_logbook')}}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover table-striped projects">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Uraian Kegiatan</th>
                                    <th>Presentase (%)</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logbook as $data)
                                <tr>
                                    <td>
                                        <h5>{{$loop->iteration}}</h5>
                                    </td>
                                    <td>
                                        {{$data->logbook_date}}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{route('pengusul_logbook_detail_uraian', [$penelitian_id, $data->logbook_id])}}">
                                            <i class="fas fa-eye">
                                            </i>

                                            Lihat Uraian
                                        </a>
                                    </td>
                                    <td>
                                        {{intval($data->logbook_presentase)}}
                                    </td>
                                    <td>
                                        <form action="{{route('pengusul_logbook_detail_destroy', [$penelitian_id, $data->logbook_id])}}" method="POST" class="form-inline form-horizontal">
                                            @csrf
                                            @method('delete')
                                            <div class="card-body">
                                                <a class="btn btn-primary btn-sm" href="{{route('pengusul_logbook_detail_edit', [$penelitian_id, $data->logbook_id])}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>

                                                    Edit
                                                </a>

                                                <button class="btn btn-danger btn-sm btn-remove" type="submit">
                                                    <i class="fas fa-trash">
                                                    </i>

                                                    Remove
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example3" class="table table-bordered table-hover table-striped projects">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>File Berkas/Foto</th>
                                    <th>Keterangan Berkas/Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($berkas as $data)
                                <tr>
                                    <td>
                                        <h5>{{$loop->iteration}}</h5>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fas fa-file-alt fa-2x"></i>
                                            </div>
                                            <div class="col-11">
                                                Nama File : {{$data->logbook_berkas_original_name}}
                                                <br>
                                                Tanggal Unggah : {{Carbon\Carbon::parse($data->logbook_berkas_date)->isoFormat('D MMMM Y')}}
                                                <br>
                                                Ukuran File : {{$data->logbook_berkas_file_size . " KB"}}
                                                <br>
                                                <a href="{{route('file_preview', [$data->logbook_berkas_id, $data->logbook_berkas_hash_name,'logbook_berkas'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                                <a href="{{route('file_download', [$data->logbook_berkas_id, $data->logbook_berkas_hash_name,'logbook_berkas'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{$data->logbook_berkas_keterangan}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Berkas Kegiatan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('pengusul_logbook_detail_store_berkas', $penelitian_id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="keterangan">Keterangan Berkas</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" placeholder="Isian keterangan Berkas" value="{{old('keterangan')}}">
                                    @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="file">File Berkas</label>
                                    <div class="input-group  @error('file') is-invalid @enderror">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" name="file">
                                            <label class="custom-file-label" id="file_label" for="file">Upload File Disini</label>
                                        </div>
                                    </div>
                                    @error('file')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <a href="{{route('pengusul_logbook_detail', $penelitian_id)}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card -->
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
    });
</script>

<!-- bs-custom-file-input -->
<script src="{{URL::asset('assets/js/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endpush