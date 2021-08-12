@extends('layout.layout_admin')

@section('title',  __('id.template') . ' Dokumen')

@section('page')

@include('layout.flash_alert')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-2 content-header">
                <div class="col-sm-12">
                    <h1>{{__('id.template')}} Dokumen</h1>
                </div>
            </div>

        </div>

        {{--
            <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-3 col-md-3">
                    <a href="" class="btn btn-primary btn-md mb-3 btn-block"><i class="fas fa-plus"></i> Tambah Template Dokumen</a>
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
            </div>
        --}}

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
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover table-striped projects">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>{{__('id.template')}} Target</th>
                                    <th>Dokumen {{__('id.template')}}</th>
                                    <th>{{__('id.option')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($template as $data)
                                <tr>
                                    <td>
                                        <h5>{{$no}}</h5>
                                    </td>
                                    <td>
                                        <h5>{{$data["target"]}}</h5>
                                    </td>
                                    <td>
                                        @if($data['hash_name'] != "" || $data['hash_name'] != NULL)
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fas fa-file"></i>
                                            </div>
                                            <div class="col-11">
                                                Nama File : {{$data["original_name"]}}
                                                <br>
                                                Tanggal Update : {{Carbon\Carbon::parse($data["datetime"])->isoFormat('D MMMM Y')}}
                                                <br>
                                                <a href="{{route('file_preview', [$data['id'], $data['hash_name'], 'template_dokumen'])}}" class="ml-1 btn btn-xs btn-primary" target="__blank"><i class="fas fa-eye"></i> {{__('id.preview')}}</a>
                                                <a href="{{route('file_download', [$data['id'], $data['hash_name'], 'template_dokumen'])}}" class="ml-1 btn btn-xs btn-success"><i class="fas fa-cloud-download-alt"></i> {{__('id.download')}}</a>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="fas fa-file"></i>
                                            </div>
                                            <div class="col-11">
                                                Nama {{__('id.file')}} : -
                                                <br>
                                                Tanggal Update : -
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{route('admin_template_dokumen_destroy', $data['id'])}}" method="POST" class="form-inline form-horizontal">
                                            @csrf
                                            @method('patch')
                                            <div class="card-body">
                                                <a class="btn btn-primary btn-sm" href="{{route('admin_template_dokumen_edit', $data['id'])}}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>

                                                   {{__('id.edit')}}
                                                </a>

                                                @if($data['hash_name'] != "" || $data['hash_name'] != NULL)
                                                <input type="hidden" class="" id="name" name="name" value="{{$data['name']}}">
                                                <input type="hidden" class="" id="target" name="target" value="{{$data['target']}}">

                                                <button class="btn btn-danger btn-sm btn-remove" type="submit">
                                                    <i class="fas fa-trash">
                                                    </i>

                                                    {{__('id.remove')}}
                                                </button>
                                                @endif
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @php $no++; @endphp
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