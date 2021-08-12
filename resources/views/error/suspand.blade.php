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

@section('title', 'Suspended')

@section('suspend_banner')
@include('layout.suspend_banner')
@endsection

@section('page')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="error-page ">
                        <h2 class="headline text-warning"> <i class="fas fa-ban text-warning"></i></h2>

                        <div class="error-content">
                            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Akun Anda Ditangguhkan, Tidak Dapat Menggunakan Fitur Ini.</h3>
                            @php
                            $link_route = NULL;
                            if(Session::get('user_role') == "admin"){
                            $link_route = 'admin_home';
                            }
                            elseif(Session::get('user_role') == "reviewer"){
                            $link_route = 'reviewer_home';
                            }
                            elseif(Session::get('user_role') == "pengusul"){
                            $link_route = 'pengusul_home';
                            }
                            @endphp
                            <p>
                                Silahkan Hubungi Admin Untuk Dapat Melakukan Pemulihan Akun.
                                Anda Mungkin <a href="{{route($link_route)}}">kembali ke halaman yang benar</a>
                            </p>

                        </div>
                        <!-- /.error-content -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection 