@extends('layout.layout_reviewer')

@section('title', 'Edit Biodata')

@section('page')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Dashboard</h1>
                </div>
            </div>

        </div>

        <!--In Progress content -->
        <section class="content">

            <div class="container-fluid">
                <div class="row">

                    <!-- /.col -->
                    <div class="col-md-12 mt-4">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Biodata</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('reviewer_biodata_update')}}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukan Nama" value="{{$user->user_name}}">
                                                @error('nama')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="sex">Jenis Kelamin</label>
                                                <select class="form-control select2 @error('sex') is-invalid @enderror" data-placeholder="Pilih jenis Kelamin" style="width: 100%;" name="sex">
                                                    <option value="0" @if($user->biodata) @if($user->biodata->biodata_sex == "0"){{"selected"}}@endif @endif>Laki-Laki</option>
                                                    <option value="1" @if($user->biodata) @if($user->biodata->biodata_sex == "1"){{"selected"}}@endif @endif>Perempuan</option>
                                                </select>
                                                @error('sex')
                                                <div class="invalid-feedback">
                                                    Pilih Jenis Kelamin
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="institusi">Institusi</label>
                                                <input name="institusi" type="text" class="form-control @error('institusi') is-invalid @enderror" id="institusi" placeholder="Masukan Institusi" value="@if($user->biodata){{$user->biodata->biodata_institusi}}@endif">
                                                @error('institusi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan">Jurusan</label>
                                                <input name="jurusan" type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" placeholder="Masukan Jurusan" value="@if($user->biodata){{$user->biodata->biodata_jurusan}}@endif">
                                                @error('jurusan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="program_studi">Program Studi</label>
                                                <input name="program_studi" type="text" class="form-control @error('program_studi') is-invalid @enderror" id="program_studi" placeholder="Masukan Program Studi" value="@if($user->biodata){{$user->biodata->biodata_program_studi}}@endif">
                                                @error('program_studi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="pendidikan">Jenjang Pendidikan</label>
                                                <input name="pendidikan" type="text" class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan" placeholder="Masukan Jenjang Pendidikan" value="@if($user->biodata){{$user->biodata->biodata_pendidikan}}@endif">
                                                @error('pendidikan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatan">Jabatan</label>
                                                <input name="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" placeholder="Masukan Jabatan" value="@if($user->biodata){{$user->biodata->biodata_jabatan}}@endif">
                                                @error('jabatan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukan Alamat" value="@if($user->biodata){{$user->biodata->biodata_alamat}}@endif">
                                                @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            </div>

                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input name="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" placeholder="Masukan Tempat Lahir" value="@if($user->biodata){{$user->biodata->biodata_tempat_lahir}}@endif">
                                                @error('tempat_lahir')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                @php
                                                $tanggal_lahir = NULL;
                                                if($user->biodata){
                                                $tanggal_lahir = $user->biodata->biodata_tanggal_lahir;
                                                }
                                                
                                                @endphp
                                                <input name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" placeholder="Masukan Tanggal Lahir" value="@if($tanggal_lahir){{$tanggal_lahir}}@endif">
                                                @error('tanggal_lahir')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="no_ktp">No KTP</label>
                                                <input name="no_ktp" type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" placeholder="Masukan No KTP" value="@if($user->biodata){{$user->biodata->biodata_no_ktp}}@endif">
                                                @error('no_ktp')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="no_telp">No Telp (Optional)</label>
                                                <input name="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" placeholder="Masukan No Telp" value="@if($user->biodata){{$user->biodata->biodata_no_telp}}@endif">
                                                @error('no_telp')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp">No HP</label>
                                                <input name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="Masukan No HP" value="@if($user->biodata){{$user->biodata->biodata_no_hp}}@endif">
                                                @error('no_hp')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukan Email" value="{{$user->user_email}}">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="web">Web Personal (Optional)</label>
                                                <input name="web" type="text" class="form-control @error('web') is-invalid @enderror" id="web" placeholder="Masukan Web Personal" value="@if($user->biodata){{$user->biodata->biodata_web_personal}}@endif">
                                                @error('web')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="schoolar_id">Google Schoolar ID</label>
                                                        <input name="schoolar_id" type="text" class="form-control @error('schoolar_id') is-invalid @enderror" id="schoolar_id" placeholder="Masukan Google Schoolar ID" value="@if($user->biodata){{$user->biodata->biodata_google_schoolar_id}}@endif">
                                                        @error('schoolar_id')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="scopus_id">Scopus ID</label>
                                                        <input name="scopus_id" type="text" class="form-control @error('scopus_id') is-invalid @enderror" id="scopus_id" placeholder="Masukan Scopus ID" value="@if($user->biodata){{$user->biodata->biodata_scopus_id}}@endif">
                                                        @error('scopus_id')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <a href="{{route('reviewer_dashboard')}}" class="btn btn-danger">Batal</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


            </div>
        </section>
</div>
<!-- /.content -->


@endsection

@push('plugin')


@endpush