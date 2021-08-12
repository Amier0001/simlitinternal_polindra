@extends('layout.layout_admin')

@section('title', 'Pelaksanaan Usulan Penelitian')

@section('page')

@include('layout.flash_alert')

@push('style')
<link rel="stylesheet" href="{{URL::asset('assets/css/daterangepicker/daterangepicker.css')}}">
@endpush

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Pelaksanaan Usulan Penelitian</h1>
                </div>
            </div>

        </div>

        {{-- <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-3 col-md-3">
                    <a href="" class="btn btn-primary btn-md mb-3 btn-block"><i class="fas fa-plus"></i> Tambah Pengusul</a>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div> --}}

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin_penelitian_pelaksanaan_update')}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <input type="hidden" value="{{$waktu['id']}}" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="tahun_mulai">Tahun Periode Mulai</label>
                                            <input type="text" class="form-control @error('tahun_mulai') is-invalid @enderror" id="tahun_mulai" name="tahun_mulai" placeholder="2xxx" value="{{$waktu['start_year']}}">
                                            @error('tahun_mulai')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <br>
                                            <h2 class="text-center mt-2"> / </h2>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="tahun_selesai">Tahun Periode Selesai</label>
                                            <input type="text" class="form-control @error('tahun_selesai') is-invalid @enderror" id="tahun_selesai" name="tahun_selesai" placeholder="2xxx" value="{{$waktu['end_year']}}">
                                            @error('tahun_selesai')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Date and time range -->
                                <div class="form-group">
                                    <label>Waktu Pelaksanaan</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="waktu" name="waktu" value="{{date('Y/m/d H:i', strtotime($waktu['start_time'])) . ' - ' . date('Y/m/d H:i', strtotime($waktu['end_time']))}}">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->

                                <div class=" card-footer">
                                    <a href="" class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Update</button>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
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

<!-- date-range-picker -->
<script src="{{URL::asset('assets/js//moment/moment.min.js')}}"></script>
<script src="{{URL::asset('assets/js/daterangepicker/daterangepicker.js')}}"></script>

<script>
    $(function() {
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#waktu').daterangepicker({
            timePicker: true,
            timePickerIncrement: 5,
            timePicker24Hour: true,
            locale: {
                format: 'YYYY/MM/DD HH:mm'
            }
        });
    });
</script>
@endpush