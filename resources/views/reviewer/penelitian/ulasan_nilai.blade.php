@extends('layout.layout_reviewer')

@section('title', 'Konfirmasi Usulan Penelitian')

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
                            <form action="{{route('reviewer_penelitian_nilai_ulasan_update', [$usulan->usulan_penelitian_id])}}" method="POST" class="form-inline form-horizontal float-right">
                                @csrf
                                @method('patch')
                                <a class="btn btn-danger" href="{{route('reviewer_penelitian_nilai', [$usulan->usulan_penelitian_id])}}">
                                    <i class="fas fa-arrow-left">
                                    </i>

                                    Kembali
                                </a>
                                <button class="btn btn-success btn-confirm ml-1" type="submit">
                                    <i class="fas fa-check">
                                    </i>

                                    Kirim Nilai
                                </button>

                            </form>

                            <h5><b>Ulasan Hasil Penilaian Usulan Penelitian</b></h5>

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
                                    <th scope="col">INDIKATOR</th>
                                    <th scope="col">KETERANGAN</th>
                                    <th scope="col">NILAI</th>
                                    <th scope="col">BOBOT</th>
                                    <th scope="col">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center" scope="row">1</th>
                                    <td>
                                        Analisis Situasi
                                        <br>
                                        (Kondisi Eksisting Mitra, Persoalan Yang Dihadapi Mitra)
                                    </td>
                                    <td>{{$ket_nilai[$nilai->penilaian_usulan_nilai_1]}}</td>
                                    <td>{{$nilai->penilaian_usulan_nilai_1}}</td>
                                    <td>10%</td>
                                    <td>{{$total_nilai[1]}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">2</th>
                                    <td>
                                        Permasalahan Mitra
                                        <br>
                                        (Kecocokan Permasalahan Dan Program Serta Kompetensi Tim)
                                    </td>
                                    <td>{{$ket_nilai[$nilai->penilaian_usulan_nilai_2]}}</td>
                                    <td>{{$nilai->penilaian_usulan_nilai_2}}</td>
                                    <td>15%</td>
                                    <td>{{$total_nilai[2]}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">3</th>
                                    <td>
                                        Solusi Yang Ditawarkan
                                        <br>
                                        (Ketepatan Metode Pendekatan Untuk Mengatasi Permasalahan, Rencana Kegiatan, Kontribusi Partisipasi Mitra)
                                    </td>
                                    <td>{{$ket_nilai[$nilai->penilaian_usulan_nilai_3]}}</td>
                                    <td>{{$nilai->penilaian_usulan_nilai_3}}</td>
                                    <td>20%</td>
                                    <td>{{$total_nilai[3]}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">4</th>
                                    <td>
                                        Target Luaran
                                        <br>
                                        (Jenis Luaran Dan Spesifikasinya Sesuai Kegiatan Yang Diusulkan)
                                    </td>
                                    <td>{{$ket_nilai[$nilai->penilaian_usulan_nilai_4]}}</td>
                                    <td>{{$nilai->penilaian_usulan_nilai_4}}</td>
                                    <td>25%</td>
                                    <td>{{$total_nilai[4]}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">5</th>
                                    <td>
                                        Kelayakan Usulan
                                        <br>
                                        (Jadwal Kegiatan, Kualifikasi Tim Pelaksana, Kelengkapan Lampiran)
                                    </td>
                                    <td>{{$ket_nilai[$nilai->penilaian_usulan_nilai_5]}}</td>
                                    <td>{{$nilai->penilaian_usulan_nilai_5}}</td>
                                    <td>10%</td>
                                    <td>{{$total_nilai[5]}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">6</th>
                                    <td>
                                        Biaya Pekerjaan
                                        <br>
                                        (Kelayakan Usulan Biaya (Honorarium (Maks 30%), Bahan Habis, Peralatan), Perjalanan, Lain-Lain Pengeluaran)
                                    </td>
                                    <td>{{$ket_nilai[$nilai->penilaian_usulan_nilai_6]}}</td>
                                    <td>{{$nilai->penilaian_usulan_nilai_6}}</td>
                                    <td>20%</td>
                                    <td>{{$total_nilai[6]}}</td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th colspan="2">Total Nilai</th>
                                    <th colspan="4">{{array_sum($total_nilai)}}</th>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="row mt-5 mx-2">
                            <h6>
                                <b>Komentar :</b>
                                <br>
                                @if($nilai->penilaian_usulan_komentar)
                                {{$nilai->penilaian_usulan_komentar}}
                                @else
                                {{"-"}}
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>

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
@endpush