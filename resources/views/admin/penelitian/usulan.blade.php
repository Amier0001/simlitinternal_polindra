@extends('layout.layout_admin')

@section('title', 'Usulan Penelitian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Data Usulan Penelitian</h1>
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
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active m-1" href="{{route('admin_penelitian_usulan')}}">Semua</a></li>
                            @foreach($jurusan as $row)
                            <li class="nav-item"><a class="nav-link m-1" href="{{route('admin_penelitian_usulan_jurusan', $row->jurusan_id)}}">{{$row->jurusan_nama}}</a></li>
                            @endforeach
                        </ul>                    
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane active" id="semua">
                                <table id="example2" class="table table-bordered table-hover table-striped projects">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Pengusul</th>
                                            <th>Program Studi</th>
                                            <th>Skema</th>
                                            <th>Bidang</th>
                                            <th>Status</th>
                                            <th>{{__('id.option')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($usulan_penelitian as $usulan)
                                        <tr>
                                            <td>
                                                <h6>{{$loop->iteration}}</h6>
                                            </td>
                                            <td>
                                                <h6>{{$usulan->usulan_penelitian_judul}}</h6>
                                            </td>
                                            @php
                                            $ketua = $usulan->anggota_penelitian()
                                            ->join('users', 'users.user_id', '=', 'anggota_penelitian.anggota_penelitian_user_id')
                                            ->join('biodata', 'biodata.biodata_user_id', '=', 'anggota_penelitian.anggota_penelitian_user_id')
                                            ->where('anggota_penelitian_penelitian_id', $usulan->usulan_penelitian_id)
                                            ->where('anggota_penelitian_role', 'ketua')
                                            ->first();
                                            @endphp
                                            <td>
                                                <h6>
                                                    {{$ketua->user_name}}
                                                </h6>
                                            </td>
                                            <td>
                                                <h6>{{$ketua->biodata_program_studi}}</h6>
                                            </td>
                                            <td>
                                                <h6>
                                                    {{
                                                $usulan->join('skema_penelitian', 'skema_penelitian.skema_id', '=', 'usulan_penelitian.usulan_penelitian_skema_id')->first()->skema_label
                                            }}
                                                </h6>
                                            </td>
                                            <td>
                                                <h6>
                                                    {{
                                                $usulan->join('bidang_penelitian', 'bidang_penelitian.bidang_id', '=', 'usulan_penelitian.usulan_penelitian_bidang_id')->first()->bidang_label
                                            }}
                                                </h6>
                                            </td>
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
                                                @elseif($usulan->usulan_penelitian_status == "selesai")
                                                <h5><span class="badge badge-success">Selesai</span></h5>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="card-body">

                                                    <a class="btn btn-success btn-sm m-1" href="{{route('admin_penelitian_detail', [$usulan->usulan_penelitian_id, 'usulan'])}}">
                                                        <i class="fas fa-folder">
                                                        </i>

                                                        {{__('id.detail')}}
                                                    </a>

                                                    <a class="btn btn-primary btn-sm m-1" href="{{route('admin_penelitian_usulan_konfirmasi', $usulan->usulan_penelitian_id)}}">
                                                        <i class="fas fa-check">
                                                        </i>

                                                        {{__('id.confirmation')}}
                                                    </a>

                                                    @if($usulan->usulan_penelitian_status == "diterima" || $usulan->usulan_penelitian_status == "dimonev")
                                                    <a class="btn btn-info btn-sm m-1" href="{{route('admin_penelitian_unlock', $usulan->usulan_penelitian_id)}}">
                                                        <i class="fas fa-unlock">
                                                        </i>

                                                        Buka Akses
                                                    </a>
                                                    @endif
                                                </div>

                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
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
    });
</script>
@endpush