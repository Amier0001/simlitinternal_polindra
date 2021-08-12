@extends('layout.layout_pengusul')

@section('title', 'Edit Logobook')

@section('suspend_banner')
@include('layout.suspend_banner')
@endsection

@section('page')

@push('style')
<!-- summernote -->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/summernote/summernote-bs4.min.css')}}">
@endpush

@include('layout.flash_alert')

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
                        <h3 class="card-title">Edit Logbook</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <!-- <form action="{{route('pengusul_logbook_detail_edit', [$penelitian_id, $logbook->logbook_id])}}" method="POST" enctype="multipart/form-data"> -->
                    <form action="{{route('pengusul_logbook_detail_update', [$penelitian_id, $logbook->logbook_id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group ">
                                <label for="tanggal">Tanggal Kegiatan</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" placeholder="Tanggal Kegiatan" value="{{$logbook->logbook_date}}">
                                @error('tanggal')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="uraian">Uraian Kegiatan</label>
                                <textarea class="form-control @error('uraian') is-invalid @enderror" id="uraian" name="uraian" placeholder="Uraian kegiatan">{{$logbook->logbook_uraian_kegiatan}}</textarea>
                                @error('uraian')
                                <div class=" invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="presentase">Presentase Kegiatan (%)</label>
                                <input type="text" class="form-control @error('presentase') is-invalid @enderror" id="presentase" name="presentase" placeholder="%" value="{{intval($logbook->logbook_presentase)}}">
                                @error('presentase')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="card-footer">
                                <a href="{{route('pengusul_logbook_detail', $penelitian_id)}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Ubah</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->

               
            </div>
        </section>

    </section>

</div>

@endsection

@push('plugin')

<!-- Summernote -->
<script src="{{URL::asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script>
    $(function() {
        // Summernote
        $('#uraian').summernote()
    })
</script>

<!-- bs-custom-file-input -->
<script src="{{URL::asset('assets/js/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endpush