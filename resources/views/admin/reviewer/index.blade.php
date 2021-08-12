@extends('layout.layout_admin')

@section('title', 'Reviewer')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>Reviewer</h1>
                </div>
            </div>

        </div>

        <!--Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <div class="col-12 col-sm-3 col-md-2">
                            <a href="{{route('admin_reviewer_insert')}}" class="btn btn-primary btn-md btn-block"><i class="fas fa-plus"></i> {{__('id.insert')}} Reviewer</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover table-striped projects">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>{{__('id.avatar')}}</th>
                                    <th>NIDN</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>{{__('id.role')}}</th>
                                    <!-- <th>Status</th> -->
                                    <th>{{__('id.option')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $data)
                                @if($data->user_id != Session::get('user_id'))
                                <tr>
                                    <td>
                                        <h5> {{$loop->iteration}}</h5>
                                    </td>
                                    <td>
                                        <img alt="Avatar" class="table-avatar" src="{{URL::asset('assets/img/profile/' . $data->user_image)}}" style="height: 40px;">
                                    </td>
                                    <td>
                                        <h5>@if($data->user_nidn != NULL){{$data->user_nidn}}@else{{'-'}}@endif</h5>
                                    </td>
                                    <td>
                                        <h5>{{$data->user_name}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$data->user_email}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$data->user_role}}</h5>
                                    </td>

                                    {{--
                                    <td>
                                        <form action="{{route('admin_reviewer_suspend', $data->user_id)}}" method="POST" class="form-inline form-horizontal">
                                    @csrf
                                    @method('put')
                                    <div class="card-body">
                                        <h5>
                                            @if($data->user_ban == true)
                                            <span class="badge badge-danger">{{__('id.suspended')}}</span>
                                            @else
                                            <span class="badge badge-success">{{__('id.active')}}</span>
                                            @endif
                                        </h5>
                                        @if($data->user_ban == true)
                                        <button class="btn btn-success btn-sm btn-suspend" type="submit">
                                            <i class="fas fa-unlock">
                                            </i>
                                            {{__('id.unsuspend')}}
                                        </button>
                                        @else
                                        <button class="btn btn-danger btn-sm btn-suspend" type="submit">
                                            <i class="fas fa-lock">
                                            </i>
                                            {{__('id.suspend')}}
                                        </button>
                                        @endif
                                    </div>
                                    </form>
                                    </td>
                                    --}}

                                    <td>
                                        <form action="{{route('admin_reviewer_destroy', $data->user_id)}}" method="POST" class="form-inline form-horizontal">
                                            @csrf
                                            @method('delete')
                                            <div class="card-body">
                                                <a class="btn btn-primary btn-sm" href="{{route('admin_reviewer_edit', $data->user_id)}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>

                                                    {{__('id.edit')}}
                                                </a>

                                                <button class="btn btn-danger btn-sm btn-remove" type="submit">
                                                    <i class="fas fa-trash">
                                                    </i>

                                                    {{__('id.remove')}}
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
    $('.btn-suspend').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        swal.fire({
            title: 'Yakin?',
            text: "Apakah Anda Yakin!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Sure!',
            cancelButtonText: 'Cancel'
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