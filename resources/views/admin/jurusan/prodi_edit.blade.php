@extends('layout.layout_admin')

@section('title', __('id.edit') . ' Program Studi')

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
                        <h3 class="card-title">{{__('id.edit')}} Program Studi</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin_prodi_update', [$jurusan_id, $id])}}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Program Studi</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Program Studi" value="{{$prodi->prodi_nama}}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="card-footer">
                                <a href="{{route('admin_prodi', $jurusan_id)}}" class="btn btn-danger"><i class="fas fa-times"></i> {{__('id.cancel')}}</a>
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