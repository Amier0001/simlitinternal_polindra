@extends('layout.layout_pengusul')

@section('title', __('id.detail') . ' Usulan Penelitian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>{{__('id.detail')}} Usulan Penelitian</h1>
                </div>
            </div>

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{$back_url}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> {{__('id.back')}}</a>
                        <!-- <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Nama Ketua Pengusul</th>
                                        <td>: {{$ketua->user_name}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">NIDN</th>
                                        <td>: {{$ketua->user_nidn}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Skema</th>
                                        <td>: {{$usulan->skema_label}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Bidang</th>
                                        <td>: {{$usulan->bidang_label}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Jurusan</th>
                                        <td>: {{$ketua->biodata_jurusan}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Program Studi</th>
                                        <td>: {{$ketua->biodata_program_studi}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Nama Anggota</th>
                                        <td>: @foreach($anggota as $row){{$row->user_name . ", "}}@endforeach</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Lama Kegiatan</th>
                                        <td>: {{$usulan->usulan_penelitian_lama_kegiatan}} Tahun</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Jumlah Mahasiswa Terlibat</th>
                                        <td>: {{$usulan->usulan_penelitian_mahasiswa_terlibat}} Orang</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Tahun Usulan</th>
                                        <td>: {{$usulan->usulan_penelitian_tahun}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- IDENTITAS KETUA -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-success m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-user"></i>
                                            Identitas Pengusul - Ketua
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row m-3">
                                            <div class="col-md-12">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        Ketua
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>{{$ketua->user_name}} ({{$ketua->user_nidn}})</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small mb-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-university"></i></span> Institusi :
                                                                        @if($ketua->biodata_institusi)
                                                                        {{$ketua->biodata_institusi}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-graduation-cap"></i></span> Program Studi :
                                                                        @if($ketua->biodata_program_studi)
                                                                        {{$ketua->biodata_program_studi}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email :
                                                                        @if($ketua->user_email)
                                                                        {{$ketua->user_email}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-user-graduate"></i></span> Jenjang Pendidikan :
                                                                        @if($ketua->biodata_pendidikan)
                                                                        {{$ketua->biodata_pendidikan}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                <h6 class="text-muted ">
                                                                    <b>Tugas: </b>
                                                                    @if($ketua->anggota_penelitian_tugas)
                                                                    {{$ketua->anggota_penelitian_tugas}}
                                                                    @else
                                                                    {{"Leader"}}
                                                                    @endif
                                                                </h6>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="{{URL::asset('assets/img/profile/' . $ketua->user_image)}}" alt="user-avatar" class="img-circle img-fluid" style="width: 120px; height: 120px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- DOKUMEN USULAN -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-warning m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-pdf"></i>
                                            Dokumen usulan
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="m-3">
                                            <label for="dokumen_usulan"><i class="fas fa-file-pdf fa-2x"></i> Dokumen Usulan</label>
                                            <h6>File Usulan : @if($dokumen_usulan){{$dokumen_usulan->dokumen_usulan_original_name}}@else{{"-"}}@endif</h6>
                                            <h6>Tanggal Unggah : @if($dokumen_usulan){{Carbon\Carbon::parse($dokumen_usulan->updated_at)->isoFormat('D MMMM Y')}}@else{{"-"}}@endif</h6>
                                            <h6>Ukuran File : @if($dokumen_usulan){{$dokumen_usulan->dokumen_usulan_file_size . " KB"}}@else{{"-"}}@endif</h6>

                                            @if($dokumen_usulan)
                                            <a href="{{route('file_preview', [$id, $dokumen_usulan->dokumen_usulan_hash_name, 'usulan'])}}" class="ml-1 btn btn-sm btn-primary" target="__blank"><i class="fas fa-eye"></i> {{__('id.preview')}}</a>
                                            <a href="{{route('file_download', [$id, $dokumen_usulan->dokumen_usulan_hash_name, 'usulan'])}}" class="ml-1 btn btn-sm btn-success"><i class="fas fa-cloud-download-alt"></i> {{__('id.download')}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- IDENTITAS ANGGOTA -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-danger m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-users"></i>
                                            Identitas Pengusul - Anggota
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        @foreach($anggota as $row)
                                        <div class="row m-3">
                                            <div class="col-md-12">
                                                <div class="card bg-light d-flex flex-fill">
                                                    <div class="card-header text-muted border-bottom-0">
                                                        @if($row->anggota_penelitian_role == 'anggota1')
                                                        {{"Anggota Pengusul 1"}}
                                                        @elseif($row->anggota_penelitian_role == 'anggota2')
                                                        {{"Anggota Pengusul 2"}}
                                                        @endif
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <h2 class="lead"><b>{{$row->user_name}} ({{$row->user_nidn}})</b></h2>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class="small mb-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-university"></i></span> Institusi :
                                                                        @if($row->biodata_institusi)
                                                                        {{$row->biodata_institusi}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                    <li class="small mt-1">
                                                                        <span class="fa-li"><i class="fas fa-lg fa-graduation-cap"></i></span> Program Studi :
                                                                        @if($row->biodata_program_studi)
                                                                        {{$row->biodata_program_studi}}
                                                                        @else
                                                                        {{"-"}}
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                <h6 class="text-muted ">
                                                                    <b>Tugas: </b>
                                                                    @if($row->anggota_penelitian_tugas)
                                                                    {{$row->anggota_penelitian_tugas}}
                                                                    @else
                                                                    {{"-"}}
                                                                    @endif
                                                                </h6>
                                                            </div>
                                                            <div class="col-5 text-center">
                                                                <img src="{{URL::asset('assets/img/profile/' . $row->user_image)}}" alt="user-avatar" class="img-circle img-fluid" style="width: 120px; height: 120px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- LUARAN DAN TARGET CAPAIAN -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-secondary m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-alt"></i>
                                            Luaran Dan Target Capaian
                                        </h3>
                                    </div>
                                    <div class="card-body">

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
                                                                    <th colspan="2">

                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
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

                                                                </tr>
                                                                @endforeach
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
                                                                <th colspan="2">

                                                                </th>
                                                            </thead>
                                                            <tbody>
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

                                                                </tr>
                                                                @endforeach
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
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- DOKUMEN RAB -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-dark m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-pdf"></i>
                                            Dokumen RAB
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="m-3">
                                            <label for="dokumen_rab"><i class="fas fa-file-pdf fa-2x"></i> Dokumen Rencana Anggaran Biaya</label>
                                            <h6>File RAB : @if($dokumen_rab){{$dokumen_rab->dokumen_rab_original_name}}@else{{"-"}}@endif</h6>
                                            <h6>Tanggal Unggah : @if($dokumen_rab){{Carbon\Carbon::parse($dokumen_rab->updated_at)->isoFormat('D MMMM Y')}}@else{{"-"}}@endif</h6>
                                            <h6>Ukuran File : @if($dokumen_rab){{$dokumen_rab->dokumen_rab_file_size . " KB"}}@else{{"-"}}@endif</h6>

                                            @if($dokumen_rab)
                                            <a href="{{route('file_preview', [$id, $dokumen_rab->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-primary" target="__blank"><i class="fas fa-eye"></i> {{__('id.preview')}}</a>
                                            <a href="{{route('file_download', [$id, $dokumen_rab->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-success"><i class="fas fa-cloud-download-alt"></i> {{__('id.download')}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- DOKUMEN PENDUKUNG -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary m-2 card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-file-pdf"></i>
                                            Dokumen Mitra
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <div class="card-body">
                                                    <div class="m-3">
                                                        <label for="mitra_file"><i class="fas fa-file-pdf fa-2x"></i> Dokumen Mitra Penelitian</label>
                                                        <h6>File Mitra Penelitian : @if($mitra_file){{$mitra_file->mitra_sasaran_file_original_name}}@else{{"-"}}@endif</h6>
                                                        <h6>Tanggal Unggah : @if($mitra_file){{Carbon\Carbon::parse($mitra_file->updated_at)->isoFormat('D MMMM Y')}}@else{{"-"}}@endif</h6>
                                                        <h6>Ukuran File : @if($mitra_file){{$mitra_file->mitra_sasaran_file_size . " KB"}}@else{{"-"}}@endif</h6>

                                                        @if($mitra_file)
                                                        <a href="{{route('pengusul_penelitian_file_preview', [$id, $mitra_file->mitra_sasaran_file_hash_name, 'mitra'])}}" class="ml-1 btn btn-sm btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                                        <a href="{{route('pengusul_penelitian_file_download', [$id, $mitra_file->mitra_sasaran_file_hash_name, 'mitra'])}}" class="ml-1 btn btn-sm btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
                                                        @endif
                                                    </div>
                                                </div>
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