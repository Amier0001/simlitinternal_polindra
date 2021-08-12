@extends('layout.layout_pengusul')

@section('title', 'Logbook Uraian')

@section('suspend_banner')
@include('layout.suspend_banner')
@endsection

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Uraian Logbook</h1>
                </div>
            </div>

        </div>

        <div class="container-fluid">

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('pengusul_logbook_detail', $penelitian_id)}}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> {{__('id.back')}}</a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @php echo $logbook->logbook_uraian_kegiatan; @endphp
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </section>
    </section>
</div>
<!-- /.content -->

@endsection

@push('plugin')

@endpush 