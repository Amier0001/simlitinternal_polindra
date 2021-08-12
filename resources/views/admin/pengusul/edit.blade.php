@extends('layout.layout_admin')

@section('title', __('id.edit') . ' Pengusul')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content mt-3">

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('id.edit')}} Pengusul</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin_pengusul_update', $user->user_id)}}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" placeholder="NIDN" value="{{$user->user_nidn}}">
                                @error('nidn')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama" value="{{$user->user_name}}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sex">Jenis Kelamin</label>
                                <select class="form-control select2 @error('sex') is-invalid @enderror" data-placeholder="Pilih jenis Kelamin" style="width: 100%;" name="sex">
                                    <option value="0" @if($user->biodata_sex==0){{"selected"}}@endif>Laki-Laki</option>
                                    <option value="1" @if($user->biodata_sex==1){{"selected"}}@endif>Perempuan</option>
                                </select>
                                @error('sex')
                                <div class="invalid-feedback">
                                    {{__('id.choose')}} Jenis Kelamin
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('id.email')}}</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{__('id.email')}}" value="{{$user->user_email}}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{__('id.password')}} (Optional)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{__('id.password')}}">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="institusi">Institusi (Optional)</label>
                                <input name="institusi" type="text" class="form-control @error('institusi') is-invalid @enderror" id="institusi" placeholder="Masukan Institusi" value="{{$user->biodata_institusi}}">
                                @error('institusi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jurusan">Jurusan (Optional)</label>
                                <select class="form-control select2 @error('jurusan') is-invalid @enderror" style="width: 100%;" name="jurusan">
                                    <option value="">--Pilih Jurusan--</option>
                                    @foreach($jurusan as $data)
                                    <option value="{{$data->jurusan_nama}}" @if($user->biodata_jurusan==$data->jurusan_nama){{"selected"}}@endif>{{$data->jurusan_nama}}</option>
                                    @endforeach
                                </select>
                                @error('jurusan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="program_studi">Program Studi (Optional)</label>
                                <select class="form-control select2 @error('program_studi') is-invalid @enderror" style="width: 100%;" name="program_studi">
                                    <option value="">--Pilih Program Studi--</option>
                                    @foreach($prodi as $data)
                                    <option value="{{$data->prodi_nama}}" @if($user->biodata_program_studi==$data->prodi_nama){{"selected"}}@endif>{{$data->prodi_nama}}</option>
                                    @endforeach
                                </select>
                                @error('program_studi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pendidikan">Jenjang Pendidikan (Optional)</label>
                                <input name="pendidikan" type="text" class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan" placeholder="Masukan Jenjang Pendidikan" value="{{$user->biodata_pendidikan}}">
                                @error('pendidikan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan (Optional)</label>
                                <input name="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" placeholder="Masukan Jabatan" value="{{$user->biodata_jabatan}}">
                                @error('jabatan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            {{--
                            <div class="form-group clearfix">
                                <div class="icheck-success">
                                    <input type="checkbox" id="checkboxPrimary1" name="active" @if($user->user_active == true){{"checked"}}@endif>
                            <label for="checkboxPrimary1">
                                Active
                            </label>
                        </div>
                        <div class="icheck-danger">
                            <input type="checkbox" id="checkboxPrimary2" name="suspend" @if($user->user_ban == true){{"checked"}}@endif>
                            <label for="checkboxPrimary2">
                                Suspend
                            </label>
                        </div>
                </div>
                --}}

                <div class=" card-footer">
                    <a href="{{route('admin_pengusul')}}" class="btn btn-danger"><i class="fas fa-times"></i> {{__('id.cancel')}}</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> {{__('id.edit')}}</button>
                </div>
            </div>
            <!-- /.card-body -->
            </form>
</div>
<!-- /.card -->
</div>
</section>

</section>

</div>
@endsection

@push('plugin')

@endpush