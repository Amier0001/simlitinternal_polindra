@extends('layout.layout_admin')

@section('title', __('id.detail') . ' Penelitian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>{{__('id.detail')}} Penelitian</h1>
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
                                                                <img src="{{URL::asset('assets/img/profile/' . $ketua->user_image)}}" alt="user-avatar" class="img-circle img-fluid" style="width: 130px; height: 130px">
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
                                                                <img src="{{URL::asset('assets/img/profile/' . $row->user_image)}}" alt="user-avatar" class="img-circle img-fluid" style="width: 130px; height: 130px">
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
                                            Dokumen Mitra Penelitian
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
        <!--Content -->
        @if($nilai)
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <b>Ulasan Hasil Monev Penelitian</b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- NILAI MONEV -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">KRITERIA</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">BOBOT</th>
                                    <th scope="col">SKOR</th>
                                    <th scope="col">NILAI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center" scope="row" rowspan="2">1</th>
                                    <td>
                                        Capaian Penelitian
                                    </td>
                                    <td>
                                        {{($nilai->penilaian_monev_status_1) ? $nilai->penilaian_monev_status_1 : "-"}}
                                    </td>
                                    <td rowspan="2" class="text-center">20</td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_skor_1) ? $nilai->penilaian_monev_skor_1 : "0"}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai->penilaian_monev_nilai_1}}
                                    </td>
                                </tr>
                                <tr>
                                    
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row" rowspan="4">2</th>
                                    <td>
                                        Publikasi ilmiah/jurnal
                                    </td>
                                    <td>
                                        {{($nilai->penilaian_monev_status_2) ? $nilai->penilaian_monev_status_2 : "-"}}
                                    </td>
                                    <td rowspan="4" class="text-center">60</td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_skor_2) ? $nilai->penilaian_monev_skor_2 :"0"}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai->penilaian_monev_nilai_2}}
                                    </td>
                                </tr>
                                <tr>
                                    
                                </tr>
                                <tr>
                                   
                                </tr>
                                <tr>
                                    
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row" rowspan="2">3</th>
                                    <td>
                                        Sebagai pemakalah dalam temu ilmiah lokal/nasional
                                    </td>
                                    <td>
                                        {{($nilai->penilaian_monev_status_3) ? $nilai->penilaian_monev_status_3 : "-"}}
                                    </td>
                                    <td rowspan="2" class="text-center">10</td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_skor_3) ? $nilai->penilaian_monev_skor_3 : "0"}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai->penilaian_monev_nilai_3}}
                                    </td>
                                </tr>
                                <tr>
                                   
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">4</th>
                                    <td>
                                        Bahan Ajar
                                    </td>
                                    <td>
                                        {{($nilai->penilaian_monev_status_4) ? $nilai->penilaian_monev_status_4 : "-"}}
                                    </td>
                                    <td class="text-center">10</td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_skor_4) ? $nilai->penilaian_monev_skor_4 : "0"}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai->penilaian_monev_nilai_4}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">5</th>
                                    <td>
                                        TTG/produk/model/ purwarupa/desain/ prototip
                                    </td>
                                    <td>
                                        {{($nilai->penilaian_monev_status_5) ? $nilai->penilaian_monev_status_5 : "-"}}
                                    </td>
                                    <td class="text-center">10</td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_skor_5) ? $nilai->penilaian_monev_skor_5 : "0"}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai->penilaian_monev_nilai_5}}
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th colspan="3">Jumlah</th>
                                    <th>100</th>
                                    <th>
                                        {{
                                            $nilai->penilaian_monev_skor_1 +
                                            $nilai->penilaian_monev_skor_2 +
                                            $nilai->penilaian_monev_skor_3 +
                                            $nilai->penilaian_monev_skor_4 +
                                            $nilai->penilaian_monev_skor_5 
                                           
                                        }}
                                    </th>
                                    <th>
                                        {{
                                            $nilai->penilaian_monev_nilai_1 +
                                            $nilai->penilaian_monev_nilai_2 +
                                            $nilai->penilaian_monev_nilai_3 +
                                            $nilai->penilaian_monev_nilai_4 +
                                            $nilai->penilaian_monev_nilai_5 
                                            
                                        }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="row mt-5 mx-2">
                            <h6>
                                <b>Komentar :</b>
                                <br>
                                @if($nilai->penilaian_monev_komentar)
                                {{$nilai->penilaian_monev_komentar}}
                                @else
                                {{"-"}}
                                @endif
                            </h6>
                        </div>
                    </div>

                    @if($capaian)
                    <!-- CAPAIAN KEGIATAN -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center pb-4 mt-4">
                                <b>
                                    Monev Capaian Kegiatan Pengabdian
                                </b>
                            </h4>

                            <table class="table table-bordered" style="table-layout: fixed;">
                                <thead>
                                    <tr class="text-center">
                                        <!-- <th scope="col">NO</th>
                                        <th scope="col">KRITERIA</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">BOBOT</th>
                                        <th scope="col">SKOR</th>
                                        <th scope="col">NILAI</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- CAPAIAN -->
                                    <div>
                                        <tr>
                                            <td> <label>Mitra Kegiatan</label></td>
                                            <td>
                                                {{($capaian->mitra_kegiatan) ? $capaian->mitra_kegiatan : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label>Jumlah Mitra</label></td>
                                            @php
                                            $decode_jumlah_mitra = json_decode($capaian->jumlah_mitra, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    {{($decode_jumlah_mitra['orang']) ? $decode_jumlah_mitra['orang'] : "0"}}
                                                    <div class="col">
                                                        <label>Orang</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_jumlah_mitra['usaha']) ? $decode_jumlah_mitra['usaha'] : "0"}}
                                                    <div class="col">
                                                        <label>Usaha</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label>Pendidikan Mitra</label></td>
                                            @php
                                            $decode_pendidikan_mitra = json_decode($capaian->pendidikan_mitra, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    {{($decode_pendidikan_mitra['s3']) ? $decode_pendidikan_mitra['s3'] : "0"}}
                                                    <div class="col">
                                                        <label>S-3 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_pendidikan_mitra['s2']) ? $decode_pendidikan_mitra['s2'] : "0"}}
                                                    <div class="col">
                                                        <label>S-2 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_pendidikan_mitra['s1']) ? $decode_pendidikan_mitra['s1'] : "0"}}
                                                    <div class="col">
                                                        <label>S-1 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_pendidikan_mitra['diploma']) ? $decode_pendidikan_mitra['diploma'] : "0"}}
                                                    <div class="col">
                                                        <label>Diploma (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_pendidikan_mitra['sma']) ? $decode_pendidikan_mitra['sma'] : "0"}}
                                                    <div class="col">
                                                        <label>SMA (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_pendidikan_mitra['smp']) ? $decode_pendidikan_mitra['smp'] : "0"}}
                                                    <div class="col">
                                                        <label>SMP (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_pendidikan_mitra['sd']) ? $decode_pendidikan_mitra['sd'] : "0"}}
                                                    <div class="col">
                                                        <label>SD (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_pendidikan_mitra['tidak_berpendidikan']) ? $decode_pendidikan_mitra['tidak_berpendidikan'] : "0"}}
                                                    <div class="col">
                                                        <label>Tidak Berpendidikan (Orang)</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Persoalan Mitra</label></td>
                                            <td>
                                                {{($capaian->persoalan_mitra) ? $capaian->persoalan_mitra : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Status Sosial Mitra:
                                                </label>
                                                <br>
                                                <p>Pengusaha Mikro, Anggota Koperasi, Kelompok Tani/Nelayan, PKK/Karang Taruna, Lainnya (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                {{($capaian->status_sosial_mitra) ? $capaian->status_sosial_mitra : "-"}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- LOKASI -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Lokasi
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Jarak PT Ke Lokasi Mitra
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    {{($capaian->jarak_lokasi_mitra) ? $capaian->jarak_lokasi_mitra : "-"}}
                                                    <div class="col">
                                                        <label>KM</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Sarana transportasi:
                                                </label>
                                                <br>
                                                <p>Angkutan umum, motor, jalan kaki (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                {{($capaian->sarana_transportasi) ? $capaian->sarana_transportasi : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Sarana komunikasi:
                                                </label>
                                                <br>
                                                <p>Telepon, Internet, Surat, Fax, Tidak ada sarana komunikasi (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                {{($capaian->sarana_komunikasi) ? $capaian->sarana_komunikasi : "-"}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- IDENTITAS -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Identitas
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <!-- <h5 class="text-center"> -->
                                                <b>
                                                    Tim Pengabdian Masyarakat
                                                </b>
                                                <!-- </h5> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Jumlah dosen
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    {{($capaian->jumlah_dosen) ? $capaian->jumlah_dosen : "0"}}
                                                    <div class="col">
                                                        <label>Orang</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Jumlah mahasiswa
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    {{($capaian->jumlah_mahasiswa) ? $capaian->jumlah_mahasiswa : "0"}}
                                                    <div class="col">
                                                        <label>Orang</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Gelar Akademik Tim
                                                </label>
                                            </td>
                                            @php
                                            $decode_gelar_akademik_tim = json_decode($capaian->gelar_akademik_tim, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    {{($decode_gelar_akademik_tim['s3']) ? $decode_gelar_akademik_tim['s3'] : "0"}}
                                                    <div class="col">
                                                        <label>S-3 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_gelar_akademik_tim['s2']) ? $decode_gelar_akademik_tim['s2'] : "0"}}
                                                    <div class="col">
                                                        <label>S-2 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_gelar_akademik_tim['s1']) ? $decode_gelar_akademik_tim['s1'] : "0"}}
                                                    <div class="col">
                                                        <label>S-1 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_gelar_akademik_tim['gb']) ? $decode_gelar_akademik_tim['gb'] : "0"}}
                                                    <div class="col">
                                                        <label>GB (Orang)</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Gender
                                                </label>
                                            </td>
                                            @php
                                            $decode_gender = json_decode($capaian->gender, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    {{($decode_gender['pria']) ? $decode_gender['pria'] : "0"}}
                                                    <div class="col">
                                                        <label>Laki-Laki (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    {{($decode_gender['wanita']) ? $decode_gender['wanita'] : "0"}}
                                                    <div class="col">
                                                        <label>Perempuan (Orang)</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <!-- <h5 class="text-center"> -->
                                                <b>
                                                    Aktivitas Pengabdian Masyarakat
                                                </b>
                                                <!-- </h5> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Metode Pelaksanaan Kegiatan:
                                                </label>
                                                <br>
                                                <p>Penyuluhan/Penyadaran , Pendampingan Pendidikan, Demplot, Rancang Bangun, Pelatihan Manajemen Usaha, Pelatihan Produksi, Pelatihan Administrasi, Pengobatan, Lainnya (tuliskan yang sesuai)</p>
                                            </td>
                                            <td>
                                                {{($capaian->metode_pelaksanaan_kegiatan) ? $capaian->metode_pelaksanaan_kegiatan : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Waktu Efektif Pelaksanaan Kegiatan
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    {{($capaian->waktu_efektif_pelaksanaan_kegiatan) ? $capaian->waktu_efektif_pelaksanaan_kegiatan : "-"}}
                                                    <div class="col">
                                                        <label>Bulan</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <!-- <h5 class="text-center"> -->
                                                <b>
                                                    Evaluasi Kegiatan
                                                </b>
                                                <!-- </h5> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Keberhasilan
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->keberhasilan) ? $capaian->keberhasilan : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <!-- <h5 class="text-center"> -->
                                                <b>
                                                    Indikator Keberhasilan
                                                </b>
                                                <!-- </h5> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Keberlanjutan Kegiatan Di Mitra
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->keberlanjutan_kegiatan_mitra) ? $capaian->keberlanjutan_kegiatan_mitra : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Kapasitas Produksi
                                                </label>
                                            </td>
                                            @php
                                            $decode_kapasitas_produksi = json_decode($capaian->kapasitas_produksi, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Sebelum PM</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{($decode_kapasitas_produksi['sebelum']) ? $decode_kapasitas_produksi['sebelum'] : "-"}}
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Setelah PM</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{($decode_kapasitas_produksi['setelah']) ? $decode_kapasitas_produksi['setelah'] : "-"}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Omzet per bulan
                                                </label>
                                            </td>
                                            @php
                                            $decode_omzet_perbulan = json_decode($capaian->omzet_perbulan, true);
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Sebelum PM Rp.</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{($decode_omzet_perbulan['sebelum']) ? $decode_omzet_perbulan['sebelum'] : "-"}}
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Setelah PM Rp.</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{($decode_omzet_perbulan['setelah']) ? $decode_omzet_perbulan['setelah'] : "-"}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Persoalan Masyarakat Mitra
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->persoalan_masyarakat_mitra) ? $capaian->persoalan_masyarakat_mitra : "-"}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- BIAYA PROGRAM -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Biaya Program
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    PNBP
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Rp. </b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{($capaian->biaya_pnbp) ? $capaian->biaya_pnbp : "-"}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Sumber Lain
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Rp. </b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{($capaian->biaya_sumber_lain) ? $capaian->biaya_sumber_lain : "-"}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- LIKUIDITAS DANA PROGRAM -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Likuiditas Dana Program
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    a) Tahapan pencairan dana
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->tahapan_pencairan_dana) ? $capaian->tahapan_pencairan_dana : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    b) Jumlah dana
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->jumlah_dana) ? $capaian->jumlah_dana : "-"}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- KONTRIBUSI MITRA -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Kontribusi Mitra
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Peran Serta Mitra dalam Kegiatan
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->peran_serta_mitra) ? $capaian->peran_serta_mitra : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Kontribusi Pendanaan
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->kontribusi_pendanaan) ? $capaian->kontribusi_pendanaan : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Peranan Mitra
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->peranan_mitra) ? $capaian->peranan_mitra : "-"}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- KEBERLANJUTAN -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Keberlanjutan
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Alasan Kelanjutan Kegiatan Mitra
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->alasan_kelanjutan_kegiatan) ? $capaian->alasan_kelanjutan_kegiatan : "-"}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- Usul penyempurnaan program Pengabdian Masyarakat -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Usul penyempurnaan program Pengabdian Masyarakat
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Model Usulan Kegiatan
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->model_usulan_kegiatan) ? $capaian->model_usulan_kegiatan : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Anggaran Biaya
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Rp. </b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        {{($capaian->anggaran_biaya) ? $capaian->anggaran_biaya : "-"}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Lain-Lain
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->lain_lain) ? $capaian->lain_lain : "-"}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- DOKUMENTASI -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Dokumentasi (Foto kegiatan dan Produk)
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Produk/kegiatan yang dinilai bermanfaat
                                                    dari berbagai perspektif (Tuliskan)
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->kegiatan_yang_dinilai) ? $capaian->kegiatan_yang_dinilai : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Potret permasalahan lain yang terekam
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->potret_permasalahan) ? $capaian->potret_permasalahan : "-"}}
                                            </td>
                                        </tr>
                                    </div>

                                    <!-- Luaran program Pengabdian Masyarakat berupa -->
                                    <div>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="text-center">
                                                    <b>
                                                        Luaran program Pengabdian Masyarakat berupa
                                                    </b>
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Jasa
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->jasa) ? $capaian->jasa : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Metode atau sistem
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->metode) ? $capaian->metode : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Produk/barang
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->produk) ? $capaian->produk : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Paten
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->paten) ? $capaian->paten : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Publikasi (artikel / proceeding)
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->publikasi_artikel) ? $capaian->publikasi_artikel : "-"}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Publikasi Media masa
                                                </label>
                                            </td>
                                            <td>
                                                {{($capaian->publikasi_media_massa) ? $capaian->publikasi_media_massa : "-"}}
                                            </td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </section>
        @endif
    </section> 
</div>
<!-- /.content -->


</div>
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