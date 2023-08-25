

@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Agency</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Agency</li>
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
                @if (str_contains( auth()->user()->level_access, 'Admin'))
                <button class="edit-modal btn btn-info"
                onclick="window.location='{{ url('/6462/75728974') }}'">
                    <span class="glyphicon glyphicon-edit"></span> Create
                </button>
                @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>PIC Full Name</th>
                        <th>Total Platform</th>
                        <th>Total Host</th>
                        @if (str_contains( auth()->user()->level_access, 'Admin'))
                        <th data-priority="1">Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data['data_modal'] as $item)
                            <tr>
                                <td>{{$item['agency_code']}}</td>
                                <td>{{$item['agency_name']}}</td>
                                <td>{{$item['pic_fullname']}}</td>
                                <td>{{$item['total_platform']}}</td>
                                <td>{{$item['total_host']}}</td>
                                
                                @if (str_contains( auth()->user()->level_access, 'Admin'))
                                <td>
                                    <button class="edit-modal btn btn-info"
                                    onclick="window.location='{{ url('/6462/'.$item['id'].'/75728972') }}'"
                                        data-info="{{$item['id']}},{{$item['agency_name']}}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </button>
                                    {{-- <button class="delete-modal btn btn-danger"
                                    onclick="window.location='{{ url('/6462/'.$item['id'].'/75728976') }}'"
                                        data-info="{{$item['id']}},{{$item['agency_name']}}">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button> --}}
                                    <button type="button" class="btn btn-danger button-delete" data-toggle="modal" data-target="#modal-danger" data-delete-link="{{ route('agency.destroy', $item['id']) }}">
                                        Delete
                                    </button>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>PIC Full Name</th>
                        <th>Total Platform</th>
                        <th>Total Host</th>
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