

@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Platform</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Platform</li>
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
                onclick="window.location='{{ url('/6462/75729974') }}'">
                    <span class="glyphicon glyphicon-edit"></span> Create
                </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Platform Code</th>
                        <th>Platform Name</th>
                        <th>Platform Status</th>
                        <th>Total Agency</th>
                        <th>Total Host</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data['data_modal'] as $item)
                            <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['platform_name']}}</td>
                                <td>{{$item['platform_status']}}</td>
                                <td>{{$item['total_agency']}}</td>
                                <td>{{$item['total_host']}}</td>
                                <td>
                                    <button class="edit-modal btn btn-info"
                                    onclick="window.location='{{ url('/6462/'.$item['id'].'/75729972') }}'"
                                        data-info="{{$item['id']}},{{$item['platform_name']}}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </button>
                                    <button class="delete-modal btn btn-danger"
                                    onclick="window.location='{{ url('/6462/'.$item['id'].'/75729976') }}'"
                                        data-info="{{$item['id']}},{{$item['platform_name']}}">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Platform Code</th>
                        <th>Platform Name</th>
                        <th>Platform Status</th>
                        <th>Total Agency</th>
                        <th>Total Host</th>
                        <th>Actions</th>
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
@endsection

<!-- jQuery -->
<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>