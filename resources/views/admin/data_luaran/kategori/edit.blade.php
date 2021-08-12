@extends('layout.layout_admin')

@section('title', __('id.edit') . ' Kategori Luaran')

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
                        <h3 class="card-title">{{__('id.edit')}} Kategori Luaran</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin_data_luaran_kategori_update', $kategori->kategori_luaran_id)}}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="label">Nama Kategori</label>
                                <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" placeholder="Nama Kategori" value="{{$kategori->kategori_luaran_label}}">
                                @error('label')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="required">Kategori Tipe</label>
                                <select class="form-control select2 @error('required') is-invalid @enderror" data-placeholder="Select Required" style="width: 100%;" name="required">
                                    <option value="wajib" @if($kategori->kategori_luaran_required=='wajib' ){{"selected"}}@endif>Wajib</option>
                                    <option value="tambahan" @if($kategori->kategori_luaran_required=='tambahan' ){{"selected"}}@endif>Tambahan</option>
                                </select>
                                @error('required')
                                <div class="invalid-feedback">
                                    {{__('id.please_select')}} Kategori Tipe
                                </div>
                                @enderror
                            </div>

                            <div class="card-footer">
                                <a href="{{route('admin_data_luaran')}}" class="btn btn-danger"><i class="fas fa-times"></i> {{__('id.cancel')}}</a>
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