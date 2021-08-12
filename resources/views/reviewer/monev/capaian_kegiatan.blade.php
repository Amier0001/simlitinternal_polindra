@extends('layout.layout_reviewer')

@section('title', 'Monev Capaian Kegiatan Penelitian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Monev Capaian Kegiatan Pengabdian</h1>
                </div>
            </div>

        </div>

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
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light">
                            <h5><b>Form Monev Pengabdian</b></h5>
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
                                </tbody>
                            </table>
                        </div>

                        <form action="{{route('reviewer_monev_capaian_update', $id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

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
                                                <input type="text" class="form-control @error('mitra_kegiatan') is-invalid @enderror" id="mitra_kegiatan" name="mitra_kegiatan" value="@if($capaian){{$capaian->mitra_kegiatan}}@else{{old('mitra_kegiatan')}}@endif">
                                                @error('mitra_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label>Jumlah Mitra</label></td>
                                            @php
                                            $decode_jumlah_mitra = NULL;
                                            if($capaian){
                                            $decode_jumlah_mitra = json_decode($capaian->jumlah_mitra, true);
                                            }
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('jumlah_mitra_orang') is-invalid @enderror" id="jumlah_mitra_orang" name="jumlah_mitra_orang" value="@if($capaian){{$decode_jumlah_mitra['orang']}}@else{{old('jumlah_mitra_orang')}}@endif">
                                                        @error('jumlah_mitra_orang')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Orang</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('jumlah_mitra_usaha') is-invalid @enderror" id="jumlah_mitra_usaha" name="jumlah_mitra_usaha" value="@if($capaian){{$decode_jumlah_mitra['usaha']}}@else{{old('jumlah_mitra_usaha')}}@endif">
                                                        @error('jumlah_mitra_usaha')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Usaha</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <label>Pendidikan Mitra</label></td>
                                            @php
                                            $decode_pendidikan_mitra = NULL;
                                            if($capaian){
                                            $decode_pendidikan_mitra = json_decode($capaian->pendidikan_mitra, true);
                                            }
                                            @endphp
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_s3') is-invalid @enderror" id="pendidikan_mitra_s3" name="pendidikan_mitra_s3" value="@if($capaian){{$decode_pendidikan_mitra['s3']}}@else{{old('pendidikan_mitra_s3')}}@endif">
                                                        @error('pendidikan_mitra_s3')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-3 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_s2') is-invalid @enderror" id="pendidikan_mitra_s2" name="pendidikan_mitra_s2" value="@if($capaian){{$decode_pendidikan_mitra['s2']}}@else{{old('pendidikan_mitra_s2')}}@endif">
                                                        @error('pendidikan_mitra_s2')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-2 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_s1') is-invalid @enderror" id="pendidikan_mitra_s1" name="pendidikan_mitra_s1" value="@if($capaian){{$decode_pendidikan_mitra['s1']}}@else{{old('pendidikan_mitra_s1')}}@endif">
                                                        @error('pendidikan_mitra_s1')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-1 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_diploma') is-invalid @enderror" id="pendidikan_mitra_diploma" name="pendidikan_mitra_diploma" value="@if($capaian){{$decode_pendidikan_mitra['diploma']}}@else{{old('pendidikan_mitra_diploma')}}@endif">
                                                        @error('pendidikan_mitra_diploma')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Diploma (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_sma') is-invalid @enderror" id="pendidikan_mitra_sma" name="pendidikan_mitra_sma" value="@if($capaian){{$decode_pendidikan_mitra['sma']}}@else{{old('pendidikan_mitra_sma')}}@endif">
                                                        @error('pendidikan_mitra_sma')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>SMA (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_smp') is-invalid @enderror" id="pendidikan_mitra_smp" name="pendidikan_mitra_smp" value="@if($capaian){{$decode_pendidikan_mitra['smp']}}@else{{old('pendidikan_mitra_smp')}}@endif">
                                                        @error('pendidikan_mitra_smp')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>SMP (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_sd') is-invalid @enderror" id="pendidikan_mitra_sd" name="pendidikan_mitra_sd" value="@if($capaian){{$decode_pendidikan_mitra['sd']}}@else{{old('pendidikan_mitra_sd')}}@endif">
                                                        @error('pendidikan_mitra_sd')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>SD (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('pendidikan_mitra_ts') is-invalid @enderror" id="pendidikan_mitra_ts" name="pendidikan_mitra_ts" value="@if($capaian){{$decode_pendidikan_mitra['tidak_berpendidikan']}}@else{{old('pendidikan_mitra_ts')}}@endif">
                                                        @error('pendidikan_mitra_ts')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Tidak Berpendidikan (Orang)</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Persoalan Mitra</label></td>
                                            <td>
                                                <input type="text" class="form-control @error('persoalan_mitra') is-invalid @enderror" id="persoalan_mitra" name="persoalan_mitra" value="@if($capaian){{$capaian->persoalan_mitra}}@else{{old('persoalan_mitra')}}@endif">
                                                @error('persoalan_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <input type="text" class="form-control @error('status_sosial_mitra') is-invalid @enderror" id="status_sosial_mitra" name="status_sosial_mitra" value="@if($capaian){{$capaian->status_sosial_mitra}}@else{{old('status_sosial_mitra')}}@endif">
                                                @error('status_sosial_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('jarak_lokasi_mitra') is-invalid @enderror" id="jarak_lokasi_mitra" name="jarak_lokasi_mitra" value="@if($capaian){{$capaian->jarak_lokasi_mitra}}@else{{('jarak_lokasi_mitra')}}@endif">
                                                        @error('jarak_lokasi_mitra')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
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
                                                <input type="text" class="form-control @error('sarana_transportasi') is-invalid @enderror" id="sarana_transportasi" name="sarana_transportasi" value="{{old('sarana_transportasi')}}">
                                                @error('sarana_transportasi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <input type="text" class="form-control @error('sarana_komunikasi') is-invalid @enderror" id="sarana_komunikasi" name="sarana_komunikasi" value="{{old('sarana_komunikasi')}}">
                                                @error('sarana_komunikasi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('jumlah_dosen') is-invalid @enderror" id="jumlah_dosen" name="jumlah_dosen" value="{{old('jumlah_dosen')}}">
                                                        @error('jumlah_dosen')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
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
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('jumlah_mahasiswa') is-invalid @enderror" id="jumlah_mahasiswa" name="jumlah_mahasiswa" value="{{old('jumlah_mahasiswa')}}">
                                                        @error('jumlah_mahasiswa')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
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
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gelar_akademik_tim_s3') is-invalid @enderror" id="gelar_akademik_tim_s3" name="gelar_akademik_tim_s3" value="{{old('gelar_akademik_tim_s3')}}">
                                                        @error('gelar_akademik_tim_s3')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-3 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gelar_akademik_tim_s2') is-invalid @enderror" id="gelar_akademik_tim_s2" name="gelar_akademik_tim_s2" value="{{old('gelar_akademik_tim_s2')}}">
                                                        @error('gelar_akademik_tim_s2')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-2 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gelar_akademik_tim_s1') is-invalid @enderror" id="gelar_akademik_tim_s1" name="gelar_akademik_tim_s1" value="{{old('gelar_akademik_tim_s1')}}">
                                                        @error('gelar_akademik_tim_s1')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>S-1 (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gelar_akademik_tim_gb') is-invalid @enderror" id="gelar_akademik_tim_gb" name="gelar_akademik_tim_gb" value="{{old('gelar_akademik_tim_gb')}}">
                                                        @error('gelar_akademik_tim_gb')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
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
                                            <td>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gender_pria') is-invalid @enderror" id="gender_pria" name="gender_pria" value="{{old('gender_pria')}}">
                                                        @error('gender_pria')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label>Laki-Laki (Orang)</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('gender_wanita') is-invalid @enderror" id="gender_wanita" name="gender_wanita" value="{{old('gender_wanita')}}">
                                                        @error('gender_wanita')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
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
                                                <input type="text" class="form-control @error('metode_pelaksanaan_kegiatan') is-invalid @enderror" id="metode_pelaksanaan_kegiatan" name="metode_pelaksanaan_kegiatan" value="{{old('metode_pelaksanaan_kegiatan')}}">
                                                @error('metode_pelaksanaan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('waktu_efektif_pelaksanaan') is-invalid @enderror" id="waktu_efektif_pelaksanaan" name="waktu_efektif_pelaksanaan" value="{{old('waktu_efektif_pelaksanaan')}}">
                                                        @error('waktu_efektif_pelaksanaan')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
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
                                                <div class="icheck-primary">
                                                    <input type="radio" id="keberhasilan_berhasil" name="keberhasilan" value="berhasil">
                                                    <label for="keberhasilan_berhasil">
                                                        Berhasil
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="keberhasilan_gagal" name="keberhasilan" value="gagal">
                                                    <label for="keberhasilan_gagal">
                                                        Gagal
                                                    </label>
                                                </div>
                                                @error('keberhasilan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <div class="icheck-primary">
                                                    <input type="radio" id="keberlanjutan_kegiatan_berlanjut" name="keberlanjutan_kegiatan" value="berlanjut">
                                                    <label for="keberlanjutan_kegiatan_berlanjut">
                                                        Berlanjut
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="keberlanjutan_kegiatan_berhenti" name="keberlanjutan_kegiatan" value="berhenti">
                                                    <label for="keberlanjutan_kegiatan_berhenti">
                                                        Berhenti
                                                    </label>
                                                </div>
                                                @error('keberlanjutan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Kapasitas Produksi
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Sebelum PM</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('kapasitas_produksi_sebelum') is-invalid @enderror" id="kapasitas_produksi_sebelum" name="kapasitas_produksi_sebelum" value="{{old('kapasitas_produksi_sebelum')}}">
                                                        @error('kapasitas_produksi_sebelum')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Setelah PM</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('kapasitas_produksi_setelah') is-invalid @enderror" id="kapasitas_produksi_setelah" name="kapasitas_produksi_setelah" value="{{old('kapasitas_produksi_setelah')}}">
                                                        @error('kapasitas_produksi_setelah')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
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
                                            <td>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Sebelum PM Rp.</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('omzet_per_bulan_sebelum') is-invalid @enderror" id="omzet_per_bulan_sebelum" name="omzet_per_bulan_sebelum" value="{{old('omzet_per_bulan_sebelum')}}">
                                                        @error('omzet_per_bulan_sebelum')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row">
                                                    <!-- <div class="col"> -->
                                                    <b>Setelah PM Rp.</b>
                                                    <!-- </div> -->
                                                    <div class="col">
                                                        <input type="text" class="form-control @error('omzet_per_bulan_setelah') is-invalid @enderror" id="omzet_per_bulan_setelah" name="omzet_per_bulan_setelah" value="{{old('omzet_per_bulan_setelah')}}">
                                                        @error('omzet_per_bulan_setelah')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
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
                                                <div class="icheck-primary">
                                                    <input type="radio" id="persoalan_masyarakat_mitra_terselesaikan" name="persoalan_masyarakat_mitra" value="Terselesaikan">
                                                    <label for="persoalan_masyarakat_mitra_terselesaikan">
                                                        Terselesaikan
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="persoalan_masyarakat_mitra_tidak_terselesaikan" name="persoalan_masyarakat_mitra" value="Tidak Terselesaikan">
                                                    <label for="persoalan_masyarakat_mitra_tidak_terselesaikan">
                                                        Tidak Terselesaikan
                                                    </label>
                                                </div>
                                                @error('persoalan_masyarakat_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                        <input type="text" class="form-control @error('biaya_pnbp') is-invalid @enderror" id="biaya_pnbp" name="biaya_pnbp" value="{{old('biaya_pnbp')}}">
                                                        @error('biaya_pnbp')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
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
                                                        <input type="text" class="form-control @error('biaya_sumber_lain') is-invalid @enderror" id="biaya_sumber_lain" name="biaya_sumber_lain" value="{{old('biaya_sumber_lain')}}">
                                                        @error('biaya_sumber_lain')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
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
                                                <div class="icheck-primary">
                                                    <input type="radio" id="tahap_pencairan_dana_mendukung" name="tahap_pencairan_dana" value="Mendukung Kegiatan">
                                                    <label for="tahap_pencairan_dana_mendukung">
                                                        Mendukung kegiatan
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="tahap_pencairan_dana_mengganggu" name="tahap_pencairan_dana" value="Mengganggu Kelancaran kegiatan di lapangan">
                                                    <label for="tahap_pencairan_dana_mengganggu">
                                                        Mengganggu Kelancaran kegiatan di lapangan
                                                    </label>
                                                </div>
                                                @error('tahap_pencairan_dana')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    b) Jumlah dana
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="jumlah_dana_diterima" name="jumlah_dana" value="Diterima 100%">
                                                    <label for="jumlah_dana_diterima">
                                                        Diterima 100%
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="jumlah_dana_tidak_diterima" name="jumlah_dana" value="Tidak Diterima 100%">
                                                    <label for="jumlah_dana_tidak_diterima">
                                                        Tidak Diterima 100%
                                                    </label>
                                                </div>
                                                @error('jumlah_dana')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <div class="icheck-primary">
                                                    <input type="radio" id="peran_serta_mitra_aktif" name="peran_serta_mitra" value="Aktif">
                                                    <label for="peran_serta_mitra_aktif">
                                                        Aktif
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="peran_serta_mitra_pasif" name="peran_serta_mitra" value="Pasif">
                                                    <label for="peran_serta_mitra_pasif">
                                                        Pasif
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="peran_serta_mitra_acuh" name="peran_serta_mitra" value="Acuh Tak Acuh">
                                                    <label for="peran_serta_mitra_acuh">
                                                        Acuh Tak Acuh
                                                    </label>
                                                </div>
                                                @error('peran_serta_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Kontribusi Pendanaan
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="kontribusi_pendanaan_menyediakan" name="kontribusi_pendanaan" value="Menyediakan">
                                                    <label for="kontribusi_pendanaan_menyediakan">
                                                        Menyediakan
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="kontribusi_pendanaan_tidak_menyediakan" name="kontribusi_pendanaan" value="Tidak Menyediakan">
                                                    <label for="kontribusi_pendanaan_tidak_menyediakan">
                                                        Tidak Menyediakan
                                                    </label>
                                                </div>
                                                @error('kontribusi_pendanaan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Peranan Mitra
                                                </label>
                                            </td>
                                            <td>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="peran_mitra_objek" name="peran_mitra" value="Objek Kegiatan">
                                                    <label for="peran_mitra_objek">
                                                        Objek Kegiatan
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="peran_mitra_subjek" name="peran_mitra" value="Subjek Kegiatan">
                                                    <label for="peran_mitra_subjek">
                                                        Subjek Kegiatan
                                                    </label>
                                                </div>
                                                @error('peran_mitra')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <div class="icheck-primary">
                                                    <input type="radio" id="alasan_kelanjutan_kegiatan_permintaan" name="alasan_kelanjutan_kegiatan" value="Permintaan Masyarakat">
                                                    <label for="alasan_kelanjutan_kegiatan_permintaan">
                                                        Permintaan Masyarakat
                                                    </label>
                                                </div>
                                                <div class="icheck-primary">
                                                    <input type="radio" id="alasan_kelanjutan_kegiatan_keputusan" name="alasan_kelanjutan_kegiatan" value="Keputusan Bersama">
                                                    <label for="alasan_kelanjutan_kegiatan_keputusan">
                                                        Keputusan Bersama
                                                    </label>
                                                </div>
                                                @error('alasan_kelanjutan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <input type="text" class="form-control @error('model_usulan_kegiatan') is-invalid @enderror" id="model_usulan_kegiatan" name="model_usulan_kegiatan" value="{{old('model_usulan_kegiatan')}}">
                                                @error('model_usulan_kegiatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                        <input type="text" class="form-control @error('anggaran_biaya') is-invalid @enderror" id="anggaran_biaya" name="anggaran_biaya" value="{{old('anggaran_biaya')}}">
                                                        @error('anggaran_biaya')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
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
                                                <input type="text" class="form-control @error('usul_lain_lain') is-invalid @enderror" id="usul_lain_lain" name="usul_lain_lain" value="{{old('usul_lain_lain')}}">
                                                @error('usul_lain_lain')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <input type="text" class="form-control @error('kegiatan_dinilai_bermanfaat') is-invalid @enderror" id="kegiatan_dinilai_bermanfaat" name="kegiatan_dinilai_bermanfaat" value="{{old('kegiatan_dinilai_bermanfaat')}}">
                                                @error('kegiatan_dinilai_bermanfaat')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    Potret permasalahan lain yang terekam
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('permasalahan_lain_terekam') is-invalid @enderror" id="permasalahan_lain_terekam" name="permasalahan_lain_terekam" value="{{old('permasalahan_lain_terekam')}}">
                                                @error('permasalahan_lain_terekam')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                <input type="text" class="form-control @error('jasa') is-invalid @enderror" id="jasa" name="jasa" value="{{old('jasa')}}">
                                                @error('jasa')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Metode atau sistem
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('metode') is-invalid @enderror" id="metode" name="metode" value="{{old('metode')}}">
                                                @error('metode')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Produk/barang
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('produk') is-invalid @enderror" id="produk" name="produk" value="{{old('produk')}}">
                                                @error('produk')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Paten
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('paten') is-invalid @enderror" id="paten" name="paten" value="{{old('paten')}}">
                                                @error('paten')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Publikasi (artikel / proceeding)
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('publikasi_artikel') is-invalid @enderror" id="publikasi_artikel" name="publikasi_artikel" value="{{old('publikasi_artikel')}}">
                                                @error('publikasi_artikel')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    - Publikasi Media masa
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('publikasi_media_masa') is-invalid @enderror" id="publikasi_media_masa" name="publikasi_media_masa" value="{{old('publikasi_media_masa')}}">
                                                @error('publikasi_media_masa')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </td>
                                        </tr>
                                    </div>
                                </tbody>
                            </table>

                            <div class="card-footer">
                                <a href="{{route('reviewer_monev_nilai', $id)}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> {{__('id.back')}}</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> {{__('id.submit')}}</button>
                            </div>
                        </form>
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
@endpush