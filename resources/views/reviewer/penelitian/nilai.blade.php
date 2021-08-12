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
                    <h1>Penilaian Usulan Penelitian</h1>
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
                            <h5><b>Form Penilaian Usulan Penelitian</b></h5>
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

                        <form action="{{route('reviewer_penelitian_nilai_update', $id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="form-group clearfix">
                                    <label for="nilai_1">1. Analisis Situasi</label>
                                    <p>(Kondisi Eksisting Mitra, Persoalan Yang Dihadapi Mitra)</p>
                                    <h6>Bobot : 10%</h6>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_1a" name="nilai_1" value="1" @if($nilai) @if($nilai->penilaian_usulan_nilai_1 == 1){{"checked"}}@endif @endif>
                                        <label for="nilai_1a">
                                            (1) Sangat Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_1b" name="nilai_1" value="2" @if($nilai) @if($nilai->penilaian_usulan_nilai_1 == 2){{"checked"}}@endif @endif>
                                        <label for="nilai_1b">
                                            (2) Buruk Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_1c" name="nilai_1" value="3" @if($nilai) @if($nilai->penilaian_usulan_nilai_1 == 3){{"checked"}}@endif @endif>
                                        <label for="nilai_1c">
                                            (3) Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_1d" name="nilai_1" value="4" @if($nilai) @if($nilai->penilaian_usulan_nilai_1 == 4){{"checked"}}@endif @endif>
                                        <label for="nilai_1d">
                                            (4) Baik
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_1e" name="nilai_1" value="5" @if($nilai) @if($nilai->penilaian_usulan_nilai_1 == 5){{"checked"}}@endif @endif>
                                        <label for="nilai_1e">
                                            (5) Baik Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_1f" name="nilai_1" value="6" @if($nilai) @if($nilai->penilaian_usulan_nilai_1 == 6){{"checked"}}@endif @endif>
                                        <label for="nilai_1f">
                                            (6) Istimewa
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group clearfix">
                                    <label for="nilai_2">2. Permasalahan Mitra</label>
                                    <p>(Kecocokan Permasalahan Dan Program Serta Kompetensi Tim)</p>
                                    <h6>Bobot : 15%</h6>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_2a" name="nilai_2" value="1" @if($nilai) @if($nilai->penilaian_usulan_nilai_2 == 1){{"checked"}}@endif @endif>
                                        <label for="nilai_2a">
                                            (1) Sangat Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_2b" name="nilai_2" value="2" @if($nilai) @if($nilai->penilaian_usulan_nilai_2 == 2){{"checked"}}@endif @endif>
                                        <label for="nilai_2b">
                                            (2) Buruk Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_2c" name="nilai_2" value="3" @if($nilai) @if($nilai->penilaian_usulan_nilai_2 == 3){{"checked"}}@endif @endif>
                                        <label for="nilai_2c">
                                            (3) Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_2d" name="nilai_2" value="4" @if($nilai) @if($nilai->penilaian_usulan_nilai_2 == 4){{"checked"}}@endif @endif>
                                        <label for="nilai_2d">
                                            (4) Baik
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_2e" name="nilai_2" value="5" @if($nilai) @if($nilai->penilaian_usulan_nilai_2 == 5){{"checked"}}@endif @endif>
                                        <label for="nilai_2e">
                                            (5) Baik Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_2f" name="nilai_2" value="6" @if($nilai) @if($nilai->penilaian_usulan_nilai_2 == 6){{"checked"}}@endif @endif>
                                        <label for="nilai_2f">
                                            (6) Istimewa
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group clearfix">
                                    <label for="nilai_3">3. Solusi Yang Ditawarkan</label>
                                    <p>(Ketepatan Metode Pendekatan Untuk Mengatasi Permasalahan, Rencana Kegiatan, Kontribusi Partisipasi Mitra)</p>
                                    <h6>Bobot : 20%</h6>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_3a" name="nilai_3" value="1" @if($nilai) @if($nilai->penilaian_usulan_nilai_3 == 1){{"checked"}}@endif @endif>
                                        <label for="nilai_3a">
                                            (1) Sangat Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_3b" name="nilai_3" value="2" @if($nilai) @if($nilai->penilaian_usulan_nilai_3 == 2){{"checked"}}@endif @endif>
                                        <label for="nilai_3b">
                                            (2) Buruk Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_3c" name="nilai_3" value="3" @if($nilai) @if($nilai->penilaian_usulan_nilai_3 == 3){{"checked"}}@endif @endif>
                                        <label for="nilai_3c">
                                            (3) Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_3d" name="nilai_3" value="4" @if($nilai) @if($nilai->penilaian_usulan_nilai_3 == 4){{"checked"}}@endif @endif>
                                        <label for="nilai_3d">
                                            (4) Baik
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_3e" name="nilai_3" value="5" @if($nilai) @if($nilai->penilaian_usulan_nilai_3 == 5){{"checked"}}@endif @endif>
                                        <label for="nilai_3e">
                                            (5) Baik Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_3f" name="nilai_3" value="6" @if($nilai) @if($nilai->penilaian_usulan_nilai_3 == 6){{"checked"}}@endif @endif>
                                        <label for="nilai_3f">
                                            (6) Istimewa
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group clearfix">
                                    <label for="nilai_4">4. Target Luaran</label>
                                    <p>(Jenis Luaran Dan Spesifikasinya Sesuai Kegiatan Yang Diusulkan)</p>
                                    <h6>Bobot : 25%</h6>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_4a" name="nilai_4" value="1" @if($nilai) @if($nilai->penilaian_usulan_nilai_4 == 1){{"checked"}}@endif @endif>
                                        <label for="nilai_4a">
                                            (1) Sangat Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_4b" name="nilai_4" value="2" @if($nilai) @if($nilai->penilaian_usulan_nilai_4 == 2){{"checked"}}@endif @endif>
                                        <label for="nilai_4b">
                                            (2) Buruk Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_4c" name="nilai_4" value="3" @if($nilai) @if($nilai->penilaian_usulan_nilai_4 == 3){{"checked"}}@endif @endif>
                                        <label for="nilai_4c">
                                            (3) Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_4d" name="nilai_4" value="4" @if($nilai) @if($nilai->penilaian_usulan_nilai_4 == 4){{"checked"}}@endif @endif>
                                        <label for="nilai_4d">
                                            (4) Baik
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_4e" name="nilai_4" value="5" @if($nilai) @if($nilai->penilaian_usulan_nilai_4 == 5){{"checked"}}@endif @endif>
                                        <label for="nilai_4e">
                                            (5) Baik Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_4f" name="nilai_4" value="6" @if($nilai) @if($nilai->penilaian_usulan_nilai_4 == 6){{"checked"}}@endif @endif>
                                        <label for="nilai_4f">
                                            (6) Istimewa
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group clearfix">
                                    <label for="nilai_5">5. Kelayakan Usulan</label>
                                    <p>(Jadwal Kegiatan, Kualifikasi Tim Pelaksana, Kelengkapan Lampiran)</p>
                                    <h6>Bobot : 10%</h6>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_5a" name="nilai_5" value="1" @if($nilai) @if($nilai->penilaian_usulan_nilai_5 == 1){{"checked"}}@endif @endif>
                                        <label for="nilai_5a">
                                            (1) Sangat Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_5b" name="nilai_5" value="2" @if($nilai) @if($nilai->penilaian_usulan_nilai_5 == 2){{"checked"}}@endif @endif>
                                        <label for="nilai_5b">
                                            (2) Buruk Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_5c" name="nilai_5" value="3" @if($nilai) @if($nilai->penilaian_usulan_nilai_5 == 3){{"checked"}}@endif @endif>
                                        <label for="nilai_5c">
                                            (3) Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_5d" name="nilai_5" value="4" @if($nilai) @if($nilai->penilaian_usulan_nilai_5 == 4){{"checked"}}@endif @endif>
                                        <label for="nilai_5d">
                                            (4) Baik
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_5e" name="nilai_5" value="5" @if($nilai) @if($nilai->penilaian_usulan_nilai_5 == 5){{"checked"}}@endif @endif>
                                        <label for="nilai_5e">
                                            (5) Baik Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_5f" name="nilai_5" value="6" @if($nilai) @if($nilai->penilaian_usulan_nilai_5 == 6){{"checked"}}@endif @endif>
                                        <label for="nilai_5f">
                                            (6) Istimewa
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group clearfix">
                                    <label for="nilai_6">6. Biaya Pekerjaan</label>
                                    <p>(Kelayakan Usulan Biaya (Honorarium (Maks 30%), Bahan Habis, Peralatan), Perjalanan, Lain-Lain Pengeluaran)</p>
                                    <h6>Bobot : 20%</h6>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_6a" name="nilai_6" value="1" @if($nilai) @if($nilai->penilaian_usulan_nilai_6 == 1){{"checked"}}@endif @endif>
                                        <label for="nilai_6a">
                                            (1) Sangat Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_6b" name="nilai_6" value="2" @if($nilai) @if($nilai->penilaian_usulan_nilai_6 == 2){{"checked"}}@endif @endif>
                                        <label for="nilai_6b">
                                            (2) Buruk Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_6c" name="nilai_6" value="3" @if($nilai) @if($nilai->penilaian_usulan_nilai_6 == 3){{"checked"}}@endif @endif>
                                        <label for="nilai_6c">
                                            (3) Buruk
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_6d" name="nilai_6" value="4" @if($nilai) @if($nilai->penilaian_usulan_nilai_6 == 4){{"checked"}}@endif @endif>
                                        <label for="nilai_6d">
                                            (4) Baik
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_6e" name="nilai_6" value="5" @if($nilai) @if($nilai->penilaian_usulan_nilai_6 == 5){{"checked"}}@endif @endif>
                                        <label for="nilai_6e">
                                            (5) Baik Sekali
                                        </label>
                                    </div>
                                    <div class="icheck-primary">
                                        <input type="radio" id="nilai_6f" name="nilai_6" value="6" @if($nilai) @if($nilai->penilaian_usulan_nilai_6 == 6){{"checked"}}@endif @endif>
                                        <label for="nilai_6f">
                                            (6) Istimewa
                                        </label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label for="komentar">Komentar</label>
                                    <textarea class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar" placeholder="Komentar">{{old('komentar')}}</textarea>
                                    @error('komentar')
                                    <div class=" invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{route('reviewer_penelitian_detail', $id)}}" class="btn btn-danger"><i class="fas fa-times"></i> Batal</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                            </div>
                        </form>
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
@endpush