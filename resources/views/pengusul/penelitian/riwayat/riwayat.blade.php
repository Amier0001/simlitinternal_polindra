@extends('layout.layout_pengusul')

@section('title', 'Riwayat Usulan Penelitian')

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
                    <h1>Riwayat Usulan Penelitian</h1>
                </div>
            </div>

        </div>

        <div class="container-fluid">

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <!-- USULAN PENelitian -->
                <div class="card">
                    <div class="card-header">
                        <b>Riwayat Usulan Penelitian Kepada Masyarakat</b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover table-striped projects">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($riwayat_penelitian as $riwayat)
                                <tr>
                                    <td>
                                        <h5>{{$loop->iteration}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$riwayat->usulan_penelitian_judul}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$riwayat->usulan_penelitian_tahun}}</h5>
                                    </td>
                                    <td>
                                        @if($riwayat->usulan_penelitian_status == "dikirim")
                                        <h5><span class="badge badge-primary">Dikirim</span></h5>
                                        @elseif($riwayat->usulan_penelitian_status == "diterima")
                                        <h5><span class="badge badge-success">Diterima</span></h5>
                                        @elseif($riwayat->usulan_penelitian_status == "ditolak")
                                        <h5><span class="badge badge-danger">Ditolak</span></h5>
                                        @elseif($riwayat->usulan_penelitian_status == "dinilai")
                                        <h5><span class="badge badge-info">Dinilai</span></h5>
                                        @elseif($riwayat->usulan_penelitian_status == "pending")
                                        <h5><span class="badge badge-warning">Pending</span></h5>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="card-body">
                                            <a class="btn btn-success btn-sm" href="{{route('pengusul_penelitian_detail', [$riwayat->usulan_penelitian_id, 'riwayat'])}}">
                                                <i class="fas fa-folder">
                                                </i>

                                                {{__('id.detail')}}
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                {{-- <!-- RIWAYAT -->
                <div class="card">
                    <div class="card-header">
                        <b> Riwayat Penelitian Kepada Masyarakat </b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example3" class="table table-bordered table-hover table-striped projects">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tahun</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayat_penelitian as $riwayat)
                                <tr>
                                    <td>
                                        <h5>{{$loop->iteration}}</h5>
                </td>
                <td>
                    <h5>{{$riwayat->usulan_penelitian_judul}}</h5>
                </td>
                <td>
                    <h5>{{$riwayat->usulan_penelitian_tahun}}</h5>
                </td>

                <td>
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm" href="">
                            <i class="fas fa-folder">
                            </i>

                            Detail
                        </a>
                    </div>
                </td>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
            <!-- /.card-body -->
</div>
<!-- /.card --> --}}
</div>
</section>
</section>
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
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pagingType": "simple_numbers",
            "language": {
                "url": "{{URL::asset('assets/js/datatables/Indonesian.json')}}"
            },
        });
        $('#example3').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
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
@endpush