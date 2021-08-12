@extends('layout.layout_admin')

@section('title', __('id.plotting') . ' Reviewer')

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
                        <h3 class="card-title">{{__('id.plotting')}} Monev Reviewer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin_plotting_monev_give_reviewer_update', $usulan_id)}}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="reviewer">Reviewer</label>
                                <select class="form-control select2-reviewer @error('reviewer') is-invalid @enderror" style="width: 100%;" name="reviewer" id="reviewer">
                                    <option value="">--Reviewer--</option>
                                    @foreach($reviewer as $row)
                                    <option value="{{$row->user_id}}">{{$row->user_name . " (" . $row->user_nidn . ")"}}</option>
                                    @endforeach
                                </select>
                                @error('reviewer')
                                <div class="invalid-feedback">
                                    Pilih Reviewer
                                </div>
                                @enderror
                            </div>

                            <div class=" card-footer">
                                <a href="{{route('admin_plotting_reviewer')}}" class="btn btn-danger"><i class="fas fa-times"></i> {{__('id.cancel')}}</a>
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
<!-- Select2 -->
<script src="{{URL::asset('assets/js/select2/js/select2.full.min.js')}}"></script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2-reviewer').select2()
    });
</script>
@endpush 