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
                        <h3 class="card-title">Substansi usulan penelitian Kepada Masyarakat</h3>
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
                                                            <a class="btn btn-success btn-sm" href="{{route('pengusul_penelitian_tambah_luaran', [$id, 'wajib'])}}">
                                                                <i class="fas fa-plus">
                                                                </i>
                                                                Tambah
                                                            </a>
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

                                                        <td>
                                                            <form action="{{route('pengusul_penelitian_destroy_luaran', [$id, $data->usulan_luaran_id])}}" method="POST" class="form-inline form-horizontal">
                                                                @csrf
                                                                @method('delete')
                                                                {{--
                                                                <a class="btn btn-primary btn-sm" href="{{route('pengusul_penelitian_edit_luaran', [$id, $data->usulan_luaran_id,'wajib'])}}">
                                                                <i class="fas fa-pencil-alt">
                                                                </i>
                                                                Ubah
                                                                </a>
                                                                --}}

                                                                <button class="btn btn-danger btn-sm btn-remove m-1" type="submit">
                                                                    <i class="fas fa-trash">
                                                                    </i>
                                                                    Hapus
                                                                </button>
                                                            </form>

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
                                                    <th colspan="3">
                                                        <a class="btn btn-success btn-sm" href="{{route('pengusul_penelitian_tambah_luaran', [$id, 'tambahan'])}}">
                                                            <i class="fas fa-plus">
                                                            </i>
                                                            Tambah
                                                        </a>
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

                                                        <td>
                                                            <form action="{{route('pengusul_penelitian_destroy_luaran', [$id, $data->usulan_luaran_id])}}" method="POST" class="form-inline form-horizontal">
                                                                @csrf
                                                                @method('delete')
                                                                {{--
                                                                <a class="btn btn-primary btn-sm" href="{{route('pengusul_penelitian_edit_luaran', [$id, $data->usulan_luaran_id,'tambahan'])}}">
                                                                <i class="fas fa-pencil-alt">
                                                                </i>
                                                                Ubah
                                                                </a>
                                                                --}}

                                                                <button class="btn btn-danger btn-sm btn-remove m-1" type="submit">
                                                                    <i class="fas fa-trash">
                                                                    </i>
                                                                    Hapus
                                                                </button>
                                                            </form>

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

<!-- BS-Stepper -->
<script src="{{URL::asset('assets/js/bs-stepper/js/bs-stepper.min.js')}}"></script>

<script>
    // BS-Stepper Init
    // document.addEventListener('DOMContentLoaded', function() {
    //     window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    // })
</script>
@endpush