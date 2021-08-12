@extends('layout.layout_pengusul')

@section('title', 'Tambah Usulan Penelitian')

@section('suspend_banner')
@include('layout.suspend_banner')
@endsection

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
                        <h3 class="card-title">Tambah Luaran Dan Target Capaian</h3>
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
                                <div class="step active" data-target="#substansi">
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
                                <div class="step" data-target="#dokumen-pendukung">
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

                            <h4 class="text-center mt-2"><span class="badge badge-warning">TAMBAH DATA LUARAN WAJIB</span></h4>

                            <!-- CONTENT -->
                            <form action="{{route('pengusul_penelitian_store_luaran', [$id, 'wajib', 4])}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <input type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="1" readonly>
                                        @error('tahun')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kategori">Kategori Luaran</label>
                                        <select class="form-control select2 @error('kategori') is-invalid @enderror" style="width: 100%;" name="kategori">
                                            <option value="Peningkatan pemberdayaan mitra" selected>Peningkatan pemberdayaan mitra</option>
                                        </select>
                                        @error('kategori')
                                        <div class="invalid-feedback">
                                            Pilih Kategori Luaran
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis">Jenis Luaran</label>
                                        <select class="form-control select2 @error('jenis') is-invalid @enderror" style="width: 100%;" name="jenis">
                                            <option value="Peningkatan jenis produk mitra" selected>Peningkatan jenis produk mitra</option>
                                            <option value="Peningkatan keterampilan mitra">Peningkatan keterampilan mitra</option>
                                            <option value="Peningkatan pendapatan mitra">Peningkatan pendapatan mitra</option>
                                            <option value="Peningkatan jumlah aset mitra">Peningkatan jumlah aset mitra</option>
                                            <option value="Peningkatan jumlah tenaga kerja mitra">Peningkatan jumlah tenaga kerja mitra</option>
                                            <option value="Peningkatan kemampuan manajemen mitra">Peningkatan kemampuan manajemen mitra</option>
                                            <option value="Peningkatan jumlah omset mitra">Peningkatan jumlah omset mitra</option>
                                            <option value="Peningkatan income generating mitra">Peningkatan income generating mitra</option>
                                            <option value="Peningkatan jumlah produk mitra">Peningkatan jumlah produk mitra</option>
                                            <option value="Peningkatan revenue generating mitra">Peningkatan revenue generating mitra</option>
                                            <option value="Peningkatan kesehatan mitra">Peningkatan kesehatan mitra</option>
                                            <option value="Peningkatan pengetahuan mitra">Peningkatan pengetahuan mitra</option>
                                            <option value="Peningkatan pelayanan mitra">Peningkatan pelayanan mitra</option>
                                            <option value="Peningkatan kualitas produk mitra">Peningkatan kualitas produk mitra</option>
                                            <option value="Keberhasilan mitra melakukan pemasaran antar pulau">Keberhasilan mitra melakukan pemasaran antar pulau</option>
                                            <option value="Keberhasilan mitra melakukan ekspor">Keberhasilan mitra melakukan ekspor</option>
                                            <option value="Produk terstandarisasi mitra">Produk terstandarisasi mitra</option>
                                            <option value="Produk tersertifikasi mitra">Produk tersertifikasi mitra</option>
                                            <option value="Unit usaha berbadan hukum">Unit usaha berbadan hukum</option>
                                        </select>
                                        @error('jenis')
                                        <div class="invalid-feedback">
                                            Pilih Jenis Luaran
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="rencana">Rencana capaian peningkatan</label>
                                        <input type="text" class="form-control @error('rencana') is-invalid @enderror" id="rencana" name="rencana" placeholder="Rencana situs publikasi video kegiatan" value="{{old('rencana')}}">
                                        @error('rencana')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control select2 @error('status') is-invalid @enderror" style="width: 100%;" name="status">
                                            <option value="Tercapai" selected>Tercapai</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">
                                            Pilih Status
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="card-footer">
                                        <a href="{{route('pengusul_penelitian_usulan', [4, $id])}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
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
    // Ajax setup from csrf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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