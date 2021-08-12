@extends('layout.layout_admin')

@section('title', 'Buka Akses Penelitian')

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
                    <h1>Buka Akses Penelitian</h1>
                </div>
            </div>

        </div>

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
                        <form action="{{route('admin_penelitian_unlock_update', $waktu->usulan_penelitian_id)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <!-- Date and time -->
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal">Batas Tanggal</label>
                                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" placeholder="Batas Tanggal" value="{{$tanggal}}">
                                            @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="jam">Jam</label>
                                            <select class="form-control select2 @error('jam') is-invalid @enderror" style="width: 100%;" name="jam">
                                                @for($i = 0; $i <= 23; $i++) <!-- -->
                                                    <option value="{{$i}}" @if($jam==$i){{'selected'}}@endif>{{$i}}</option>
                                                    @endfor
                                            </select>
                                            @error('jam')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="menit">menit</label>
                                            <select class="form-control select2 @error('menit') is-invalid @enderror" style="width: 100%;" name="menit">
                                                @for($i = 0; $i <= 59; $i++) <!-- -->
                                                    <option value="{{$i}}" @if($menit==$i){{'selected'}}@endif>{{$i}}</option>
                                                    @endfor
                                            </select>
                                            @error('menit')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                                <div class=" card-footer">
                                    <a href="{{route('admin_penelitian_usulan')}}" class="btn btn-danger"><i class="fas fa-times"></i> {{__('id.cancel')}}</a>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> {{__('id.update')}}</button>
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