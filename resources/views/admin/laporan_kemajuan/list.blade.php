@extends('layout.layout_admin')

@section('title', 'Laporan Kemajuan')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Laporan Kemajuan</h1>
                </div>
            </div>

        </div>

        <div class="container-fluid">

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('pengusul_laporan_kemajuan')}}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- LAPORAN KEMAJUAN DAN KEUANGAN -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-warning m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-alt"></i>
                                            Laporan Kemajuan Dan Keuangan
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- LALPORAN KEMAJUAN -->
                                                <tr>
                                                    <td>
                                                        <h5><b>Laporan Kemajuan</b></h5>
                                                    </td>
                                                    <td>

                                                        @if($laporan_kemajuan)
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : {{$laporan_kemajuan->laporan_kemajuan_original_name}}
                                                                <br>
                                                                Tanggal Unggah : {{Carbon\Carbon::parse($laporan_kemajuan->laporan_kemajuan_date)->isoFormat('D MMMM Y')}}
                                                                <br>
                                                                <a href="{{route('file_preview', [$laporan_kemajuan->laporan_kemajuan_id, $laporan_kemajuan->laporan_kemajuan_hash_name,'laporan_kemajuan'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> Lihat</a>
                                                                <a href="{{route('file_download', [$laporan_kemajuan->laporan_kemajuan_id, $laporan_kemajuan->laporan_kemajuan_hash_name,'laporan_kemajuan'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> Unduh</a>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file fa-2x"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : -
                                                                <br>
                                                                Tanggal Unggah : -
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </td>
                                                </tr>

                                                <!-- LALPORAN KEUANGAN -->
                                                <tr>
                                                    <td>
                                                        <h5><b>Laporan Keuangan</b></h5>
                                                    </td>
                                                    <td>

                                                        @if($laporan_keuangan)
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : {{$laporan_keuangan->laporan_kemajuan_original_name}}
                                                                <br>
                                                                Tanggal Unggah : {{Carbon\Carbon::parse($laporan_keuangan->laporan_kemajuan_date)->isoFormat('D MMMM Y')}}
                                                                <br>
                                                                <a href="{{route('file_preview', [$laporan_keuangan->laporan_kemajuan_id, $laporan_keuangan->laporan_kemajuan_hash_name,'laporan_kemajuan'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> Lihat</a>
                                                                <a href="{{route('file_download', [$laporan_keuangan->laporan_kemajuan_id, $laporan_keuangan->laporan_kemajuan_hash_name,'laporan_kemajuan'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> Unduh</a>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file fa-2x"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : -
                                                                <br>
                                                                Tanggal Unggah : -
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- LUARAN WAJIB -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-alt"></i>
                                            Luaran Wajib
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($luaran_wajib->count() != 0)
                                                @foreach($luaran_wajib as $data)
                                                <tr>
                                                    <td>
                                                        Tahun : {{$data->usulan_luaran_penelitian_tahun}}
                                                    </td>
                                                    <td>
                                                        {{$loop->iteration}}. <b>- {{$data->usulan_luaran_penelitian_kategori}}</b>
                                                        <br>

                                                        <b>{{$data->usulan_luaran_penelitian_jenis}} (<span class="badge badge-warning">{{$data->usulan_luaran_penelitian_status}}</span>)</b>

                                                        <h5>{{$data->usulan_luaran_penelitian_rencana}}</h5>

                                                    </td>
                                                    <td>
                                                        @php
                                                        $doc = $data->laporan_luaran()->where('laporan_luaran_luaran_id', $data->usulan_luaran_id)->first();
                                                        @endphp

                                                        @if($doc)
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : {{$doc->laporan_luaran_original_name}}
                                                                <br>
                                                                Tanggal Unggah : {{Carbon\Carbon::parse($doc->laporan_luaran_date)->isoFormat('D MMMM Y')}}
                                                                <br>
                                                                <a href="{{route('file_preview', [$doc->laporan_luaran_id, $doc->laporan_luaran_hash_name,'laporan_luaran'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> Lihat</a>
                                                                <a href="{{route('file_download', [$doc->laporan_luaran_id, $doc->laporan_luaran_hash_name,'laporan_luaran'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> Unduh</a>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file fa-2x"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : -
                                                                <br>
                                                                Tanggal Unggah : -
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td class="text-center" colspan="3">Luaran Wajib Kosong</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- LUARAN TAMBAHAN -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-secondary m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-alt"></i>
                                            Luaran Tambahan
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <th colspan="3">

                                                </th>
                                            </thead>
                                            <tbody>
                                                @if($luaran_tambahan->count() != 0)
                                                @foreach($luaran_tambahan as $data)
                                                <tr>
                                                    <td>
                                                        Tahun : {{$data->usulan_luaran_penelitian_tahun}}
                                                    </td>
                                                    <td>
                                                        {{$loop->iteration}}. <b>- {{$data->usulan_luaran_penelitian_kategori}}</b>
                                                        <br>

                                                        <b>{{$data->usulan_luaran_penelitian_jenis}} (<span class="badge badge-warning">{{$data->usulan_luaran_penelitian_status}}</span>)</b>

                                                        <h5>{{$data->usulan_luaran_penelitian_rencana}}</h5>
                                                    </td>
                                                    <td>
                                                        @php
                                                        $doc = $data->laporan_luaran()->where('laporan_luaran_luaran_id', $data->usulan_luaran_id)->first();
                                                        @endphp

                                                        @if($doc)
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : {{$doc->laporan_luaran_original_name}}
                                                                <br>
                                                                Tanggal Unggah : {{Carbon\Carbon::parse($doc->laporan_luaran_date)->isoFormat('D MMMM Y')}}
                                                                <br>
                                                                <a href="{{route('file_preview', [$doc->laporan_luaran_id, $doc->laporan_luaran_hash_name,'laporan_luaran'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                                                <a href="{{route('file_download', [$doc->laporan_luaran_id, $doc->laporan_luaran_hash_name,'laporan_luaran'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="row">
                                                            <div class="col-1">
                                                                <i class="fas fa-file fa-2x"></i>
                                                            </div>
                                                            <div class="col-11">
                                                                Nama File : -
                                                                <br>
                                                                Tanggal Unggah : -
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td class="text-center" colspan="3">Luaran Tambahan Kosong</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

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
            "ordering": true,
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
            "ordering": true,
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