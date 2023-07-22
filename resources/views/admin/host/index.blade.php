

@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Host</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Host</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('body')
        <div class="row">
            <div class="col-12">
                @if (session('error'))
                    <div class="text-danger text-center">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div class="text-success text-center">{{ session('success') }}</div>
                @endif

                <div class="card">
                <div class="card-header">
                    {{-- <h3 class="card-title">User Index</h3> --}}
                <button class="edit-modal btn btn-info"
                onclick="window.location='{{ url('/6462/75721174') }}'">
                    <span class="glyphicon glyphicon-edit"></span> Create
                </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Host UID</th>
                        <th>Host Name</th>
                        <th>Platform Name</th>
                        <th>Agency Name</th>
                        @if (str_contains( auth()->user()->level_access, 'Admin'))
                        <th>Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data['data_modal'] as $item)
                            <tr>
                                <td>{{$item['host_uid']}}</td>
                                <td>{{$item['host_name']}}</td>
                                <td>{{$item['platform_name']}}</td>
                                <td>{{$item['agency_name']}}</td>
                                @if (str_contains( auth()->user()->level_access, 'Admin'))
                                <td>
                                    <button class="edit-modal btn btn-info"
                                    onclick="window.location='{{ url('/6462/'.$item['id'].'/75721172') }}'"
                                        data-info="{{$item['id']}},{{$item['host_uid']}}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </button>
                                    {{-- <button class="delete-modal btn btn-danger"
                                    onclick="window.location='{{ url('/6462/'.$item['id'].'/75721176') }}'"
                                        data-info="{{$item['id']}},{{$item['host_uid']}}">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button> --}}
                                    <button type="button" class="btn btn-danger button-delete" data-toggle="modal" data-target="#modal-danger" data-delete-link="{{ route('host.destroy', $item['id']) }}">
                                        Delete
                                    </button>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Host UID</th>
                        <th>Host Name</th>
                        <th>Platform Name</th>
                        <th>Agency Name</th>
                        @if (str_contains( auth()->user()->level_access, 'Admin'))
                        <th>Actions</th>
                        @endif
                    </tr>
                    </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="modal fade" id="modal-danger">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>
                        <form method="get" id="delete-button-confirm" action="">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

<!-- jQuery -->
<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $(".button-delete").on('click', function () {
            // alert($(this).data('delete-link'));
            $('#delete-button-confirm').attr('action', $(this).data('delete-link'));
        });
    });
  </script>