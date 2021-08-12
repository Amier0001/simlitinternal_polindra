@extends('layout.layout_pengusul')

@section('title', 'Tambah Usulan Penelitian')

@section('suspend_banner')
@include('layout.suspend_banner')
@endsection

@section('page')

@if($errors->count() == 0 && Session::get('icon') && Session::get('alert') && Session::get('subalert') && $result == NULL)
@include('layout.flash_alert')
@php
Session::forget('icon');
Session::forget('alert');
Session::forget('subalert');
@endphp
@endif

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
                        <h3 class="card-title">Tambah Anggota Penelitian</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body p-0">
                        <div class="bs-stepper">
                            <!-- NAVIGASI -->
                            <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                <div class="step active" data-target="#identitas">
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

                            <form class="form-inline ml-3" action="" method="GET">

                                <div class="form-group mb-2">
                                    <label for="nidn">NIDN</label>
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="text" class="form-control" name="nidn" id="nidn" placeholder=" NIDN">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Cari</button>
                            </form>

                            <!-- CONTENT -->
                            <form action="{{route('pengusul_penelitian_store_anggota', $id)}}" method="POST" class="mt-4">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <div class="col-md-2">
                                            <div class="text-center">
                                                @php
                                                $img_src = NULL;
                                                if($result){
                                                if($result->user_image != NULL){
                                                $img_src= URL::asset('assets/img/profile/' . $result->user_image);
                                                }else{
                                                $img_src= URL::asset('assets/img/profile/default.jpg');
                                                }
                                                }else{
                                                $img_src= URL::asset('assets/img/profile/default.jpg');
                                                }
                                                @endphp
                                                <img class="profile-user-img img-fluid img-circle" src="{{$img_src}}" alt="User profile picture" style="height: 100px; width: 100px;">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <label>Nama</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <p>
                                                        @if($result)
                                                        @if($result->user_name != NULL)
                                                        {{$result->user_name}}
                                                        @else
                                                        {{"-"}}
                                                        @endif
                                                        @else
                                                        {{"-"}}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <label>Institusi</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <p>
                                                        @if($result)
                                                        @if($result->biodata()->first())
                                                        @if($result->biodata()->first()->biodata_institusi != NULL)
                                                        {{$result->biodata()->first()->biodata_institusi}}
                                                        @else
                                                        {{"-"}}
                                                        @endif
                                                        @else
                                                        {{"-"}}
                                                        @endif
                                                        @else
                                                        {{"-"}}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <label>Program Studi</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <p>
                                                        @if($result)
                                                         @if($result->biodata()->first())
                                                        @if($result->biodata()->first()->biodata_program_studi != NULL)
                                                        {{$result->biodata()->first()->biodata_program_studi}}
                                                        @else
                                                        {{"-"}}
                                                        @endif
                                                        @else
                                                        {{"-"}}
                                                        @endif
                                                        @else
                                                        {{"-"}}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-4">
                                        <div class="col-md-2">
                                            <label>Kualifikasi</label>
                                        </div>
                                        <div class="col-md-10">
                                            <p>
                                                @if($result)
                                                @if($result->biodata()->first())
                                                @if($result->biodata()->first()->biodata_pendidikan != NULL)
                                                {{$result->biodata()->first()->biodata_pendidikan}}
                                                @else
                                                {{"-"}}
                                                @endif
                                                @else
                                                {{"-"}}
                                                @endif
                                                @else
                                                {{"-"}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-10">
                                            <p>
                                                @if($result)
                                                @if($result->user_email != NULL)
                                                {{$result->user_email}}
                                                @else
                                                {{"-"}}
                                                @endif
                                                @else
                                                {{"-"}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="@if($result){{$result->user_id}}@endif">
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <label for="peran">Peran</label>
                                        </div>
                                        <div class="col-md-10">
                                            <select class="form-control select2 @error('peran') is-invalid @enderror" data-placeholder="Pilih Lama Kegiatan" style="width: 100%;" name="peran">
                                                <option value="">--Peran--</option>
                                                @if($result)
                                                @for($i = 1; $i<=2; $i++) <!-- -->
                                                    <option value="anggota{{$i}}" @if(old('peran')=="anggota" . $i ){{'selected'}}@endif>Anggota Pengusul {{$i}}</option>
                                                    @endfor
                                                    @endif
                                            </select>
                                            @error('peran')
                                            <div class="invalid-feedback">
                                                Pilih Peran
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <label for="tugas">Tugas Dalam Penelitian</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control @error('tugas') is-invalid @enderror" id="tugas" name="tugas" placeholder="Tugas Dalam Penelitian" value="{{old('tugas')}}">
                                            @error('tugas')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <a href="{{route('pengusul_penelitian_usulan', [2, $id])}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
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
<!-- BS-Stepper -->
<script src="{{URL::asset('assets/js/bs-stepper/js/bs-stepper.min.js')}}"></script>

<script>
    // BS-Stepper Init
    // document.addEventListener('DOMContentLoaded', function() {
    //     window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    // })
</script>
@endpush