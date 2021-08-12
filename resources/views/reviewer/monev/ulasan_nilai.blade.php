@extends('layout.layout_reviewer')

@section('title', 'Ulasan Nilai Monev Penelitian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Ulasan Nilai Usulan Penelitian</h1>
                </div>
            </div>

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light">
                            <form action="{{route('reviewer_monev_nilai_ulasan_update', [$usulan->usulan_penelitian_id])}}" method="POST" class="form-inline form-horizontal float-right">
                                @csrf
                                @method('patch')
                                <a class="btn btn-danger" href="{{route('reviewer_monev_capaian', [$usulan->usulan_penelitian_id])}}">
                                    <i class="fas fa-arrow-left">
                                    </i>

                                    {{__('id.back')}}
                                </a>
                                <button class="btn btn-success btn-confirm ml-1" type="submit">
                                    <i class="fas fa-check">
                                    </i>

                                    Kirim Nilai
                                </button>

                            </form>

                            <h5><b>Ulasan Hasil Monev Penelitian</b></h5>

                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Nama Ketua Pengusul</th>
                                        <td>: {{$ketua->user_name}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">NIDN</th>
                                        <td>: {{$ketua->user_nidn}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Skema</th>
                                        <td>: {{$usulan->skema_label}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Bidang</th>
                                        <td>: {{$usulan->bidang_label}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Jurusan</th>
                                        <td>: {{$ketua->biodata_jurusan}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Program Studi</th>
                                        <td>: {{$ketua->biodata_program_studi}}</td>
                                    </tr>
                                    <tr style="height: 5px;">
                                        <th scope="row" style="width: 250px;">Nama Anggota</th>
                                        <td>: @foreach($anggota as $row){{$row->user_name . ", "}}@endforeach</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">NO</th>
                                    <th scope="col">KRITERIA</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">BOBOT</th>
                                    <th scope="col">SKOR</th>
                                    <th scope="col">NILAI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center" scope="row">1</th>
                                    <td>
                                        Capaian Penelitian
                                    </td>
                                    </td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_status_1) ? $nilai->penilaian_monev_status_1 : "-"}}
                                    </td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_skor_1) ? $nilai->penilaian_monev_skor_1 : "0"}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai->penilaian_monev_nilai_1}}
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">2</th>
                                    <td>
                                        Publikasi ilmiah/jurnal
                                    </td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_status_2) ? $nilai->penilaian_monev_status_2 : "-"}}
                                    </td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_skor_2) ? $nilai->penilaian_monev_skor_2 : "0"}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai->penilaian_monev_nilai_2}}
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">3</th>
                                    <td>
                                        Sebagai pemakalah dalam temu ilmiah lokal/nasional
                                    </td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_status_3) ? $nilai->penilaian_monev_status_3 : "-"}}
                                    </td>
                                    <td class="text-center">60</td>
                                    <td class="text-center"> 
                                        {{($nilai->penilaian_monev_skor_3) ? $nilai->penilaian_monev_skor_3 :"0"}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai->penilaian_monev_nilai_3}}
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">4</th>
                                    <td>
                                        Bahan Ajar
                                    </td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_status_4) ? $nilai->penilaian_monev_status_4 : "-"}}
                                    </td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_skor_4) ? $nilai->penilaian_monev_skor_4 : "0"}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai->penilaian_monev_nilai_4}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">5</th>
                                    <td>
                                        TTG/produk/model/ purwarupa/desain/ prototip
                                    </td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_status_5) ? $nilai->penilaian_monev_status_5 : "-"}}
                                    </td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">
                                        {{($nilai->penilaian_monev_skor_5) ? $nilai->penilaian_monev_skor_5 : "0"}}
                                    </td>
                                    <td class="text-center">
                                        {{$nilai->penilaian_monev_nilai_5}}
                                    </td>
                                    
                                </tr>
                                
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th colspan="3">Jumlah</th>
                                    <th>100</th>
                                    <th>
                                        {{
                                            $nilai->penilaian_monev_skor_1 +
                                            $nilai->penilaian_monev_skor_2 +
                                            $nilai->penilaian_monev_skor_3 +
                                            $nilai->penilaian_monev_skor_4 +
                                            $nilai->penilaian_monev_skor_5 
                                            
                                        }}
                                    </th>
                                    <th>
                                        {{
                                            $nilai->penilaian_monev_nilai_1 +
                                            $nilai->penilaian_monev_nilai_2 +
                                            $nilai->penilaian_monev_nilai_3 +
                                            $nilai->penilaian_monev_nilai_4 +
                                            $nilai->penilaian_monev_nilai_5 
                                            
                                        }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="row mt-5 mx-2">
                            <h6>
                                <b>Komentar :</b>
                                <br>
                                @if($nilai->penilaian_monev_komentar)
                                {{$nilai->penilaian_monev_komentar}}
                                @else
                                {{"-"}}
                                @endif
                            </h6>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center pb-4 mt-4">
                                <b>
                                    Monev Capaian Kegiatan Penelitian
                                </b>
                            </h4>

                            <table class="table table-bordered" style="table-layout: fixed;">
                                <thead>
                                    <tr class="text-center">
                                        <!-- <th scope="col">NO</th>
                                        <th scope="col">KRITERIA</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">BOBOT</th>
                                        <th scope="col">SKOR</th>
                                        <th scope="col">NILAI</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

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
    $('.btn-confirm').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        swal.fire({
            title: 'Anda Yakin?',
            text: "Anda Tidak Dapat Mengubah Nilai Setelah Dikirimkan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kirim Nilai',
            cancelButtonText: 'Batal'
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