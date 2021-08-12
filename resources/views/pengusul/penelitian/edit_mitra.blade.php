@extends('layout.layout_pengusul')

@section('title', 'Tambah Usulan Penelitian')

@section('page')

@include('layout.flash_alert')

@push('style')
<!-- BS Stepper -->
<link rel="stylesheet" href="{{URL::asset('assets/css/bs-stepper/css/bs-stepper.min.css')}}">

@endpush

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content mt-3">

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Mitra Sasaran</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body p-0">
                        <div class="bs-stepper">
                            <!-- NAVIGASI -->
                            <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                <div class="step" data-target="#identitas">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="identitas" id="identitas-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Identitas Usulan</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#substansi">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="substansi" id="substansi-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Substansi Usulan</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#rab">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="rab" id="rab-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">RAB</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step active" data-target="#dokumen-pendukung">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="dokumen-pendukung" id="dokumen-pendukung-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">Dokumen Pendukung</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#kirim">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="kirim" id="kirim-trigger">
                                        <span class="bs-stepper-circle">5</span>
                                        <span class="bs-stepper-label">Kirim Usulan</span>
                                    </button>
                                </div>
                            </div>

                            <!-- CONTENT -->
                            <form action="{{route('pengusul_penelitian_update_mitra', [$id, $mitra->mitra_sasaran_id])}}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="tipe_mitra">Tipe Mitra</label>
                                        <select class="form-control select2 @error('tipe_mitra') is-invalid @enderror" style="width: 100%;" name="tipe_mitra">
                                            <option value="">--Tipe Mitra--</option>
                                            <option value="kelompok_masyarakat" @if($mitra->mitra_sasaran_tipe_mitra=="kelompok_masyarakat"){{'selected'}}@endif>Kelompok Masyarakat</option>
                                            <option value="umkm" @if($mitra->mitra_sasaran_tipe_mitra=="umkm"){{'selected'}}@endif>UMKM</option>
                                        </select>
                                        @error('tipe_mitra')
                                        <div class="invalid-feedback">
                                            Pilih Tipe Mitra
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_mitra">Jenis Mitra</label>
                                        <select class="form-control select2 @error('jenis_mitra') is-invalid @enderror" style="width: 100%;" name="jenis_mitra">
                                            <option value="">--Jenis Mitra--</option>
                                            <option value="Produktif Ekonomi/Wirausahawan" @if($mitra->mitra_sasaran_jenis_mitra=="Produktif Ekonomi/Wirausahawan" ){{'selected'}}@endif>Produktif Ekonomi/Wirausahawan</option>
                                            <option value="Non Produktif Ekonomi" @if($mitra->mitra_sasaran_jenis_mitra=="Non Produktif Ekonomi" ){{'selected'}}@endif>Non Produktif Ekonomi</option>
                                            <option value="Calon Wirausahawan" @if($mitra->mitra_sasaran_jenis_mitra=="Calon Wirausahawan" ){{'selected'}}@endif>Calon Wirausahawan</option>
                                        </select>
                                        @error('jenis_mitra')
                                        <div class="invalid-feedback">
                                            Pilih Jenis Mitra
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_pimpinan">Nama Pimpinan Mitra</label>
                                        <input type="text" class="form-control @error('nama_pimpinan') is-invalid @enderror" id="nama_pimpinan" name="nama_pimpinan" placeholder="Nama Pimpinan Mitra" value="{{$mitra->mitra_sasaran_nama_pimpinan_mitra}}">
                                        @error('nama_pimpinan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class=" form-group">
                                        <label for="jabatan_pimpinan">Jabatan Pimpinan Mitra</label>
                                        <input type="text" class="form-control @error('jabatan_pimpinan') is-invalid @enderror" id="jabatan_pimpinan" name="jabatan_pimpinan" placeholder="Jabatan Pimpinan Mitra" value="{{$mitra->mitra_sasaran_jabatan_pimpinan_mitra}}">
                                        @error('jabatan_pimpinan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_mitra">Nama Mitra</label>
                                        <input type="text" class="form-control @error('nama_mitra') is-invalid @enderror" id="nama_mitra" name="nama_mitra" placeholder="Nama Mitra" value="{{$mitra->mitra_sasaran_nama_mitra}}">
                                        @error('nama_mitra')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat_mitra">Alamat Mitra</label>
                                        <input type="text" class="form-control @error('alamat_mitra') is-invalid @enderror" id="alamat_mitra" name="alamat_mitra" placeholder="Alamat Mitra" value="{{$mitra->mitra_sasaran_alamat_mitra}}">
                                        @error('alamat_mitra')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-3 col-md-6">
                                            <label for="provinsi">Provinsi</label>
                                            <select class="form-control select2-provinsi @error('provinsi') is-invalid @enderror" style="width: 100%;" name="provinsi" id="provinsi">
                                                <option value="">--Provinsi--</option>
                                                @foreach($provinsi as $data)
                                                <option value="{{$data->id}}" @if($mitra->mitra_sasaran_provinsi_mitra==$data->id){{'selected'}}@endif>{{$data->nama}}</option>
                                                @endforeach
                                            </select>
                                            @error('provinsi')
                                            <div class="invalid-feedback">
                                                Pilih Provinsi
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6">
                                            <label for="kabupaten">Kabupaten / Kota</label>
                                            <select class="form-control select2-kabupaten @error('kabupaten') is-invalid @enderror" style="width: 100%;" name="kabupaten" id="kabupaten">
                                                <option value="">--Kabupaten / Kota--</option>
                                                @foreach($kabupaten as $data)
                                                <option value="{{$data->id}}" @if($mitra->mitra_sasaran_kota_mitra==$data->id){{'selected'}}@endif>{{$data->nama}}</option>
                                                @endforeach
                                            </select>
                                            @error('kabupaten')
                                            <div class="invalid-feedback">
                                                Pilih Kabupaten
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6">
                                            <label for="kecamatan">Kecamatan</label>
                                            <select class="form-control select2-kecamatan @error('kecamatan') is-invalid @enderror" style="width: 100%;" name="kecamatan" id="kecamatan">
                                                <option value="">--Kecamatan--</option>
                                                @foreach($kecamatan as $data)
                                                <option value="{{$data->id}}" @if($mitra->mitra_sasaran_kecamatan_mitra==$data->id){{'selected'}}@endif>{{$data->nama}}</option>
                                                @endforeach
                                            </select>
                                            @error('kecamatan')
                                            <div class="invalid-feedback">
                                                Pilih Kecamatan
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-3 col-md-6">
                                            <label for="desa">Desa</label>
                                            <select class="form-control select2-desa @error('desa') is-invalid @enderror" style="width: 100%;" name="desa" id="desa">
                                                <option value="">--Desa--</option>
                                                @foreach($desa as $data)
                                                <option value="{{$data->id}}" @if($mitra->mitra_sasaran_desa_mitra==$data->id){{'selected'}}@endif>{{$data->nama}}</option>
                                                @endforeach
                                            </select>
                                            @error('desa')
                                            <div class="invalid-feedback">
                                                Pilih Desa
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="jarak_mitra">Jarak Mitra (KM)</label>
                                        <input type="text" class="form-control @error('jarak_mitra') is-invalid @enderror" id="jarak_mitra" name="jarak_mitra" placeholder="Jarak Mitra (KM)" value="{{$mitra->mitra_sasaran_jarak_mitra}}">
                                        @error('jarak_mitra')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="bidang_masalah">Bidang Masalah Mitra (Minimal 1 Bidang)</label>
                                        <input type="text" class="form-control @error('bidang_masalah') is-invalid @enderror" id="bidang_masalah" name="bidang_masalah" placeholder="Bidang Masalah Mitra (Minimal 1 Bidang)" value="{{$mitra->mitra_sasaran_bidang_masalah_mitra}}">
                                        @error('bidang_masalah')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kontribusi_pendanaan">Kontribusi Pendanaan (Rp.)</label>
                                        <input type="text" class="form-control @error('kontribusi_pendanaan') is-invalid @enderror" id="kontribusi_pendanaan" name="kontribusi_pendanaan" placeholder="0" value="{{$mitra->mitra_sasaran_kontribusi_pendanaan_mitra}}">
                                        @error('kontribusi_pendanaan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="card-footer">
                                        <a href="{{route('pengusul_penelitian_usulan', [6, $id])}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save "></i> Simpan</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section>

    </section>

</div>

@endsection

@push('plugin')
<!-- Select2 -->
<script src="{{URL::asset('assets/js/select2/js/select2.full.min.js')}}"></script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2-provinsi').select2()
        $('.select2-kabupaten').select2()
        $('.select2-kecamatan').select2()
        $('.select2-desa').select2()
    });
</script>

<script>
    // Ajax setup from csrf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $('select#provinsi').change(function() {
        const provinsi_id = $(this).children("option:selected").val();

        $.ajax({
            url: "{{route('pengusul_penelitian_get_kabupaten')}}",
            method: "POST",
            data: {
                id_provinsi: provinsi_id
            },
            cache: false,
            success: function(data) {
                $('#kabupaten').empty();
                $('#kecamatan').empty();
                $('#desa').empty();
                $('#kabupaten').html(data);
                $('#kecamatan').html('<option value="">--Kecamatan--</option>');
                $('#desa').html('<option value="">--Desa--</option>');
            }
        });
    });

    $('select#kabupaten').change(function() {
        const kabupaten_id = $(this).children("option:selected").val();

        $.ajax({
            url: "{{route('pengusul_penelitian_get_kecamatan')}}",
            method: "POST",
            data: {
                id_kabupaten: kabupaten_id
            },
            cache: false,
            success: function(data) {
                $('#kecamatan').empty();
                $('#desa').empty();
                $('#kecamatan').html(data);
                $('#desa').html('<option value="">--Desa--</option>');
            }
        });
    });

    $('select#kecamatan').change(function() {
        const kecamatan_id = $(this).children("option:selected").val();

        $.ajax({
            url: "{{route('pengusul_penelitian_get_desa')}}",
            method: "POST",
            data: {
                id_kecamatan: kecamatan_id
            },
            cache: false,
            success: function(data) {
                $('#desa').empty();
                $('#desa').html(data);
            }
        });
    });
</script>

<!-- BS-Stepper -->
<script src="{{URL::asset('assets/js/bs-stepper/js/bs-stepper.min.js')}}"></script>

<script>
    // BS-Stepper Init
    // document.addEventListener('DOMContentLoaded', function() {
    //     window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    // })
</script>
@endpush