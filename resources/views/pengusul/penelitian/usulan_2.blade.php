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
                        <h3 class="card-title">Identitas Pengusul - Anggota Pelaksana Penelitian</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body p-0">
                        <div class="bs-stepper">
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

                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{route('pengusul_penelitian_tambah_anggota', $id)}}" class="btn btn-primary float-right mr-4 mb-4"><i class="fas fa-plus"></i> Tambah Anggota</a>
                                </div>
                            </div>

                            @foreach($anggota as $row)
                            <div class="row m-3">
                                <div class="col-md-10">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                            {{"Anggota Pengusul " . $row->anggota_penelitian_role_position}}
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>{{$row->user_name}} ({{$row->user_nidn}})</b></h2>
                                                    <h6 class="text-muted ">
                                                        <b>Tugas: </b>
                                                        @if($row->anggota_penelitian_tugas)
                                                        {{$row->anggota_penelitian_tugas}}
                                                        @else
                                                        {{"-"}}
                                                        @endif
                                                    </h6>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small mb-1">
                                                            <span class="fa-li"><i class="fas fa-lg fa-university"></i></span>Institusi :
                                                            @if($row->biodata_institusi)
                                                            {{$row->biodata_institusi}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </li>
                                                        <li class="small mt-1">
                                                            <span class="fa-li"><i class="fas fa-lg fa-graduation-cap"></i></span>Jurusan :
                                                            @if($row->biodata_jurusan)
                                                            {{$row->biodata_jurusan}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </li>
                                                        <li class="small mt-1">
                                                            <span class="fa-li"><i class="fas fa-lg fa-graduation-cap"></i></span>Program Studi :
                                                            @if($row->biodata_program_studi)
                                                            {{$row->biodata_program_studi}}
                                                            @else
                                                            {{"-"}}
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="{{URL::asset('assets/img/profile/' . $row->user_image)}}" alt="user-avatar" class="img-circle img-fluid" style="width: 100px; height: 100px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <form action="{{route('pengusul_penelitian_remove_anggota', [$id, $row->anggota_penelitian_id])}}" method="POST" class="float-right">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm btn-remove" type="submit">
                                                        <i class="fas fa-trash">
                                                        </i>

                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="card-footer">
                        <a href="{{route('pengusul_penelitian_usulan', [$page-1, $id])}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
                        <a href="{{route('pengusul_penelitian_usulan', [$page+1, $id])}}" class="btn btn-primary ml-auto float-right"><i class="fas fa-arrow-right"></i> Lanjut</a>
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