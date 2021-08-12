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
                        <h3 class="card-title">Rencana Anggaran Belanja</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body p-0">
                        <div class="bs-stepper">
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
                                <div class="step active" data-target="#rab">
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

                            <form action="{{route('pengusul_penelitian_upload_rab', $id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row m-4">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="dokumen_rab"><i class="fas fa-file-pdf-alt fa-2x"></i> Dokumen Rencana Anggaran Biaya (Excel, Maks 10MB)</label>
                                            <h6>File RAB : @if($dokumen_info){{$dokumen_info->dokumen_rab_original_name}}@else{{"-"}}@endif</h6>
                                            <h6>Tanggal Unggah : @if($dokumen_info){{Carbon\Carbon::parse($dokumen_info->updated_at)->isoFormat('D MMMM Y')}}@else{{"-"}}@endif</h6>
                                            <h6>Ukuran File : @if($dokumen_info){{$dokumen_info->dokumen_rab_file_size . " KB"}}@else{{"-"}}@endif</h6>

                                            @if($dokumen_info)
                                            <!-- <a href="{{route('pengusul_penelitian_file_preview', [$id, $dokumen_info->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                            <a href="{{route('pengusul_penelitian_file_download', [$id, $dokumen_info->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a> -->
                                            <a href="{{route('file_preview', [$id, $dokumen_info->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                            <a href="{{route('file_download', [$id, $dokumen_info->dokumen_rab_hash_name, 'rab'])}}" class="ml-1 btn btn-sm btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
                                            <br>
                                            <br>
                                            @endif

                                            <div class="input-group  @error('dokumen_rab') is-invalid @enderror">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input  @error('dokumen_rab') is-invalid @enderror" id="dokumen_rab" name="dokumen_rab">
                                                    <label class="custom-file-label" for="dokumen_rab">Unggah File</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Unggah</button>
                                                </div>
                                            </div>
                                            @error('dokumen_rab')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><b>Template Dokumen RAB</b></h5>
                                        @if($template['hash_name'] != "" || $template['hash_name'] != NULL)
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fas fa-file"></i>
                                            </div>
                                            <div class="col-11">
                                                Nama File : {{$template["original_name"]}}
                                                <br>
                                                Tanggal Update : {{Carbon\Carbon::parse($template["datetime"])->isoFormat('D MMMM Y')}}
                                                <br>
                                                <a href="{{route('file_preview', [$template['id'], $template['hash_name'], 'template_dokumen'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> Preview</a>
                                                <a href="{{route('file_download', [$template['id'], $template['hash_name'], 'template_dokumen'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> Download</a>
                                            </div>
                                        </div>
                                         @else
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fas fa-file"></i>
                                            </div>
                                            <div class="col-11">
                                                Nama File : -
                                                <br>
                                                Tanggal Update : -
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                            </form>

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
<!-- bs-custom-file-input -->
<script src="{{URL::asset('assets/js/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();
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