@extends('layout.layout_admin')

@section('title', __('id.edit') .' Template Dokumen')

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
                        <h3 class="card-title">{{__('id.edit')}} {{__('id.template')}} Dokumen</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin_template_dokumen_update', $id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input type="hidden" class="" id="id" name="id" value="{{$template['id']}}">
                        <input type="hidden" class="" id="name" name="name" value="{{$template['name']}}">
                        <input type="hidden" class="" id="target" name="target" value="{{$template['target']}}">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="template">Template Dokumen</label>
                                <div class="input-group  @error('template') is-invalid @enderror">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('template') is-invalid @enderror" id="template" name="template">
                                        <label class="custom-file-label" id="template_label" for="template">{{__('id.upload')}} {{__('id.file')}} Disini</label>
                                    </div>
                                </div>
                                @error('template')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="card-footer">
                                <a href="{{route('admin_template_dokumen')}}" class="btn btn-danger"><i class="fas fa-times"></i> {{__('id.cancel')}}</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> {{__('id.update')}}</button>
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
<!-- bs-custom-file-input -->
<script src="{{URL::asset('assets/js/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();
    });
</script>
@endpush 