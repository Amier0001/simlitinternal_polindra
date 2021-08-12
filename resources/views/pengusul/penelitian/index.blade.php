@extends('layout.layout_pengusul')

@section('title', 'Usulan Penelitian')

@section('suspend_banner')
@include('layout.suspend_banner')
@endsection

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- @include('layout.suspend_banner') -->

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Usulan Penelitian</h1>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            @if($is_tambah_unlock == true)
            <div class="row">
                <div class="col-12 ">
                    <div class="alert alert-info">
                        
                        <h5><i class="icon fas fa-info"></i> Waktu Pelaksanaan Usulan</h5>
                        <ul class="mb-0">
                            <li>
                                <b>Periode</b> : {{$tambah_unlock["start_year"] . " / " . $tambah_unlock["end_year"]}}
                            </li>
                            <li>
                                <b>Batas Awal</b> : {{Carbon\Carbon::parse($tambah_unlock["start_time"])->isoFormat('D MMMM Y , hh:mm:ss')}} WIB
                            <li>
                                <b>Batas Akhir</b> : {{Carbon\Carbon::parse($tambah_unlock["end_time"])->isoFormat('D MMMM Y , hh:mm:ss')}} WIB
                            </li>
                        </ul>
                        
                    </div>
                </div>
                
            </div>
                @endif
        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <!-- USULAN PENelitian -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <div class="col-12 col-sm-3 col-md-3">
                            @if($is_suspend)
                            <a style="pointer-events: none; cursor: default;" class="btn btn-info btn-md btn-block"><i class="fas fa-plus"></i> Tambah Usulan Penelitian</a>
                            @else
                            <a href="{{route('pengusul_penelitian_tambah')}}" class="btn btn-primary btn-md btn-block"><i class="fas fa-plus"></i> Tambah Usulan Penelitian</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover table-striped projects">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Penelitian</th>
                                    <!-- <th>Periode</th> -->
                                    <th>Status</th>
                                    <th>{{__('id.option')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($usulan_penelitian as $usulan)
                                <tr>
                                    <td>
                                        <h5>{{$loop->iteration}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$usulan->usulan_penelitian_judul}}</h5>
                                    </td>
                                    <!-- <td>
                                        <h5>{{$usulan->usulan_penelitian_tahun}}</h5>
                                    </td> -->
                                    <td>
                                        @if($usulan->usulan_penelitian_status == "dikirim")
                                        <h5><span class="badge badge-primary">Dikirim</span></h5>
                                        @elseif($usulan->usulan_penelitian_status == "diterima")
                                        <h5><span class="badge badge-success">Diterima</span></h5>
                                        @elseif($usulan->usulan_penelitian_status == "ditolak")
                                        <h5><span class="badge badge-danger">Ditolak</span></h5>
                                        @elseif($usulan->usulan_penelitian_status == "dinilai")
                                        <h5><span class="badge badge-info">Dinilai</span></h5>
                                        @elseif($usulan->usulan_penelitian_status == "dimonev")
                                        <h5><span class="badge badge-info">Dimonev</span></h5>
                                        @elseif($usulan->usulan_penelitian_status == "pending")
                                        <h5><span class="badge badge-warning">Pending</span></h5>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="card-body">

                                            @php $role = $usulan->anggota_penelitian()->where('anggota_penelitian_user_id', Session::get('user_id'))->first()->anggota_penelitian_role @endphp

                                            <form action="{{route('pengusul_penelitian_hapus', [$usulan->usulan_penelitian_id])}}" method="POST" class="form-inline form-horizontal">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-success btn-sm" href="{{route('pengusul_penelitian_detail', [$usulan->usulan_penelitian_id, 'usulan'])}}">
                                                    <i class="fas fa-folder">
                                                    </i>

                                                    {{__('id.detail')}}
                                                </a>

                                                @if($role == "ketua")
                                                @if($is_tambah_unlock == true)
                                                @if($usulan->usulan_penelitian_status == "pending")
                                                @if($is_suspend)
                                                <a class="btn btn-info btn-sm ml-1" style="pointer-events: none; cursor: default;">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>

                                                    {{__('id.edit')}}
                                                </a>
                                                @else
                                                <a class="btn btn-primary btn-sm ml-1" href="{{route('pengusul_penelitian_usulan', [1, $usulan->usulan_penelitian_id])}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>

                                                    {{__('id.edit')}}
                                                </a>
                                                @endif
                                                @endif
                                                @endif

                                                @if($usulan->usulan_penelitian_status == "pending")
                                                <button class="btn btn-danger btn-sm btn-remove ml-1" type="submit">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    {{__('id.remove')}}
                                                </button>
                                                @endif
                                                @endif

                                            </form>

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