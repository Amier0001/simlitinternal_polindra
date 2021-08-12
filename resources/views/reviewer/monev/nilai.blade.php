@extends('layout.layout_reviewer')

@section('title', 'Monev Penelitian')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Monev Penelitian</h1>
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
                            <h5><b>Form Monev Penelitian</b></h5>
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

                        <form action="{{route('reviewer_monev_nilai_update', $id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                                <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">NO</th>
                                        <th scope="col">KRITERIA</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">BOBOT</th>
                                        <th scope="col">SKOR</th>
                                        <!-- <th scope="col">NILAI</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-center" scope="row" rowspan="2">1</th>
                                        <td>
                                            Capaian Penelitian
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-1 @error('status_1') is-invalid @enderror" style="width: 100%;" name="status_1" id="status_1">
                                                <option value="">-Status-</option>
                                                <option value="< 25%" >< 25%</option>
                                                <option value="25 - 50%">25 - 50%</option>
                                                <option value="51 - 75%">51 - 75%</option>
                                                <option value="> 75%">> 75%</option>
                                            </select>
                                        </td>
                                        <td rowspan="2" class="text-center">30</td>
                                        <td>
                                            <select class="form-control select2-skor-1 @error('skor_1') is-invalid @enderror" style="width: 100%;" name="skor_1" id="skor_1">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_1 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row" rowspan="4">2</th>
                                        <td>
                                            Publikasi ilmiah/jurnal
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-2 @error('status_2') is-invalid @enderror" style="width: 100%;" name="status_2" id="status_2">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Draft">Draft</option>
                                                <option value="Submitted">Submitted</option>
                                                <option value="Accepted">Accepted</option>
                                                <option value="Published">Published</option>
                                            </select>
                                        </td>
                                        <td rowspan="4" class="text-center">20</td>
                                        <td>
                                            <select class="form-control select2-skor-2 @error('skor_2') is-invalid @enderror" style="width: 100%;" name="skor_2" id="skor_2">
                                                <option value="">-Skor-</option>
                                                <option value="1"  @if($nilai) @if($nilai->penilaian_monev_skor_2 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2"  @if($nilai) @if($nilai->penilaian_monev_skor_2 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3"  @if($nilai) @if($nilai->penilaian_monev_skor_2 == "2"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4"  @if($nilai) @if($nilai->penilaian_monev_skor_2 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5"  @if($nilai) @if($nilai->penilaian_monev_skor_2 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6"  @if($nilai) @if($nilai->penilaian_monev_skor_2 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                         
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row" rowspan="2">3</th>
                                        <td>
                                            Sebagai pemakalah dalam temu ilmiah lokal/nasional
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-3 @error('status_3') is-invalid @enderror" style="width: 100%;" name="status_3" id="status_3">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Draft">Draft</option>
                                                <option value="Terdaftar">Terdaftar</option>
                                                <option value="Sudah Dilaksanakan">Sudah Dilaksanakan</option>
                                            </select>
                                        </td>
                                        <td rowspan="2" class="text-center">20</td>
                                        <td>
                                            <select class="form-control select2-skor-3 @error('skor_3') is-invalid @enderror" style="width: 100%;" name="skor_3" id="skor_3">
                                                <option value="">-Skor-</option>
                                                <option value="1"  @if($nilai) @if($nilai->penilaian_monev_skor_3 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2"  @if($nilai) @if($nilai->penilaian_monev_skor_3 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3"  @if($nilai) @if($nilai->penilaian_monev_skor_3 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4"  @if($nilai) @if($nilai->penilaian_monev_skor_3 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5"  @if($nilai) @if($nilai->penilaian_monev_skor_3 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6"  @if($nilai) @if($nilai->penilaian_monev_skor_3 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">4</th>
                                        <td>
                                            Bahan Ajar
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-4 @error('status_4') is-invalid @enderror" style="width: 100%;" name="status_4" id="status_4">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Draft">Draft</option>
                                                <option value="Editting">diproses penerbit (editing)</option>
                                                <option value="Sudah Terbit">Sudah Terbit</option>
                                            </select>
                                        </td>
                                        <td class="text-center">10</td>
                                        <td>
                                            <select class="form-control select2-skor-4 @error('skor_4') is-invalid @enderror" style="width: 100%;" name="skor_4" id="skor_4">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_4 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" scope="row">5</th>
                                        <td>
                                            TTG/produk/model/ purwarupa/desain/ prototip
                                        </td>
                                        <td>
                                            <select class="form-control select2-status-5 @error('status_5') is-invalid @enderror" style="width: 100%;" name="status_5" id="status_5">
                                                <option value="">-Status-</option>
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Draft">Draft</option>
                                                <option value="Produk">Produk</option>
                                                <option value="Penerapan">Penerapan</option>
                                            </select>
                                        </td>
                                        <td class="text-center">20</td>
                                        <td>
                                            <select class="form-control select2-skor-5 @error('skor_5') is-invalid @enderror" style="width: 100%;" name="skor_5" id="skor_5">
                                                <option value="">-Skor-</option>
                                                <option value="1" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "1"){{"selected"}}@endif @endif>(1) Buruk</option>
                                                <option value="2" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "2"){{"selected"}}@endif @endif>(2) Sangat Kurang</option>
                                                <option value="3" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "3"){{"selected"}}@endif @endif>(3) Kurang</option>
                                                <option value="4" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "4"){{"selected"}}@endif @endif>(4) Cukup</option>
                                                <option value="5" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "5"){{"selected"}}@endif @endif>(5) Baik</option>
                                                <option value="6" @if($nilai) @if($nilai->penilaian_monev_skor_5 == "6"){{"selected"}}@endif @endif>(6) Sangat Baik</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="text-center">
                                        <th colspan="3">Jumlah</th>
                                        <th>100</th>
                                        <th colspan="2"></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="form-group">
                                <label for="komentar">Komentar</label>
                                <textarea class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar" placeholder="Komentar">{{old('komentar')}}</textarea>
                                @error('komentar')
                                <div class=" invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{route('reviewer_monev_detail', $id)}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> {{__('id.back')}}</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> {{__('id.submit')}}</button>
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