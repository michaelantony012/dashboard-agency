

@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Recruit</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Recruit</li>
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
                {{-- <button class="edit-modal btn btn-info"
                onclick="window.location='{{ url('/6462/75721074') }}'">
                    <span class="glyphicon glyphicon-edit"></span> Create
                </button> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Recruit Number</th>
                        <th>Platform Name</th>
                        <th>Agency Name</th>
                        <th>Recruit Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data['data_modal'] as $item)
                            <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['platform_name']}}</td>
                                <td>{{$item['agency_name']}}</td>
                                <td>{{$item['recruit_status']}}</td>
                                <td>
                                    <button class="edit-modal btn btn-info"
                                    onclick="window.location='{{ url('/6462/'.$item['id'].'/75721072') }}'"
                                        data-info="{{$item['id']}},{{$item['recruit_status']}}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </button>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Recruit Number</th>
                        <th>Platform Name</th>
                        <th>Agency Name</th>
                        <th>Recruit Status</th>
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