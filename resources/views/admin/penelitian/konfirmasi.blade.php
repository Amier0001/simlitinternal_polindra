@extends('layout.layout_admin')

@section('title', __('id.confirmation') . ' Usulan Penelitian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content mt-3">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>{{__('id.confirmation')}} Usulan Penelitian</h1>
                </div>
            </div>

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- general form elements -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <a href="{{route('admin_penelitian_usulan')}}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> {{__('id.back')}}</a>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{route('admin_penelitian_usulan_konfirmasi_update', $id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control select2 @error('status') is-invalid @enderror" data-placeholder="Select Status" style="width: 100%;" name="status">
                                        <option value="">Konfirmasi Status...</option>
                                        <option value="1" @if($konfirmasi->status == 'diterima'){{"selected"}}@endif>Terima</option>
                                        <option value="0" @if($konfirmasi->status == 'ditolak'){{"selected"}}@endif>Tolak</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{__('id.please_select')}} Status
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{route('admin_penelitian_usulan')}}" class="btn btn-danger"><i class="fas fa-times"></i> {{__('id.cancel')}}</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> {{__('id.confirmation')}}</button>
                            </div>
                        </form>

                    </div>

                    <div class="card-body">
                        <div class="alert alert-light">
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
                                    <td>{{$ket_nilai[($nilai) ? $nilai->penilaian_usulan_nilai_1 : 0]}}</td>
                                    <td>{{($nilai) ? $nilai->penilaian_usulan_nilai_1 : 0}}</td>
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
                                    <td>{{$ket_nilai[($nilai) ? $nilai->penilaian_usulan_nilai_2 : 0]}}</td>
                                    <td>{{($nilai) ? $nilai->penilaian_usulan_nilai_2 : 0}}</td>
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
                                    <td>{{$ket_nilai[($nilai) ? $nilai->penilaian_usulan_nilai_3 : 0]}}</td>
                                    <td>{{($nilai) ? $nilai->penilaian_usulan_nilai_3 : 0}}</td>
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
                                    <td>{{$ket_nilai[($nilai) ? $nilai->penilaian_usulan_nilai_4 : 0]}}</td>
                                    <td>{{($nilai) ? $nilai->penilaian_usulan_nilai_4 : 0}}</td>
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
                                    <td>{{$ket_nilai[($nilai) ? $nilai->penilaian_usulan_nilai_5 : 0]}}</td>
                                    <td>{{($nilai) ? $nilai->penilaian_usulan_nilai_5 : 0}}</td>
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
                                    <td>{{$ket_nilai[($nilai) ? $nilai->penilaian_usulan_nilai_6 : 0]}}</td>
                                    <td>{{($nilai) ? $nilai->penilaian_usulan_nilai_6 : 0}}</td>
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
                                @if($nilai)
                                {{($nilai) ? $nilai->penilaian_usulan_komentar : "-"}}
                                @else
                                {{"-"}}
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </section>

    </section>

</div>
@endsection

@push('plugin')

@endpush