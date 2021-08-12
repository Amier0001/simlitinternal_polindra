@php

$profile_layout = NULL;

if(Session::get('user_role') == "admin"){
$profile_layout = 'layout.layout_admin';
}elseif(Session::get('user_role') == "reviewer"){
$profile_layout = 'layout.layout_reviewer';
}elseif(Session::get('user_role') == "pengusul"){
$profile_layout = 'layout.layout_pengusul';
}

@endphp

@extends($profile_layout)

@section('title', 'Profile Setting')

@section('suspend_banner')
@include('layout.suspend_banner')
@endsection

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <!--In Progress content -->
        <section class="content">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-3 mt-4">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{URL::asset('assets/img/profile/' . $user->user_image)}}" alt="User profile picture" style="height: 88px; width: 88px;">
                                </div>

                                <h3 class="profile-username text-center">{{Str::words($user->user_name, 3)}}</h3>


                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Role</b> <a class="float-right">{{$user->user_role}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>NIDN</b>
                                        <a class="float-right">
                                            @if($user->user_nidn)
                                            {{$user->user_nidn}}
                                            @else
                                            {{"-"}}
                                            @endif
                                        </a>
                                    </li>
                                </ul>

                                @if($user_id == Session::get('user_id'))
                                <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-primary btn-block"><b><i class="fas fa-camera"></i> Unggah Foto Profil</b></button>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                    <div class="col-md-9 mt-4">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link" href="{{route('profile', 'me')}}">Profil</a></li>
                                    @if($user_id == Session::get('user_id'))
                                    <li class="nav-item"><a class="nav-link active" href="#">Pengaturan</a></li>
                                    @endif
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane" id="profile">

                                    </div>
                                    <!-- /.tab-pane -->

                                    @if($user_id == Session::get('user_id'))
                                    <div class="tab-pane  active" id="settings">
                                        <!-- general form elements -->
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Account</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <!-- form start -->
                                            <form action="{{route('profile_setting_update', 'me')}}" method="POST">
                                                @csrf
                                                @method('patch')
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="name">Nama Lengkap</label>
                                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter name" value="{{$user->user_name}}">
                                                        @error('name')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Alamat Email</label>
                                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" value="{{$user->user_email}}">
                                                        @error('email')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->

                                                <div class="card-footer">
                                                    <button type="reset" class="btn btn-danger">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.card -->

                                        <!-- general form elements -->
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h3 class="card-title">Ganti Kata Sandi</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <!-- form start -->
                                            <form action="{{route('profile_setting_update_password', 'me')}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="old_password">Ganti Password</label>
                                                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="old_password" placeholder="Enter old password">
                                                        @error('old_password')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="new_password">Password Baru</label>
                                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" placeholder="Enter new password">
                                                        @error('new_password')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="confirm_password">Konfirmasi password baru</label>
                                                        <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" id="confirm_password" placeholder="Enter confirm password">
                                                        @error('confirm_password')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->

                                                <div class="card-footer">
                                                    <button type="reset" class="btn btn-danger">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.tab-pane -->
                                    @endif
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

        </section>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@if($user_id == Session::get('user_id'))
<!-- Upload Profile Picture Modal Form -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Profile Picture</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('profile_setting_update_picture', 'me')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="image">Picture Upload</label>
                            <div class="input-group @error('image') is-invalid @enderror">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input  @error('image') is-invalid @enderror" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>
                            @error('image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endif
@endsection

@push('plugin')

@error('image')
<script type="text/javascript">
    $(document).ready(function() {
        $('#modal-default').modal('show');
    });
</script>
@enderror

<!-- bs-custom-file-input -->
<script src="{{URL::asset('assets/js/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endpush