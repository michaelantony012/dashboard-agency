

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
                        <th>Total Agency</th>
                        <th>Total Host</th>
                        <th style="width: 100px;">Platform Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data['data_modal'] as $item)
                            <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['platform_name']}}</td>
                                {{-- <td>{{$item['platform_status']}}</td> --}}
                                <td>{{$item['total_agency']}}</td>
                                <td>{{$item['total_host']}}</td>
                                <td>
                                    <input type="checkbox" {{ $item['platform_status_toggle'] }} class="changeplatformstatus" data-toggle="toggle"  data-id="{{ $item['id'] }}">
                                </td>  
                                <td>
                                    <button class="edit-modal btn btn-info"
                                    onclick="window.location='{{ url('/6462/'.$item['id'].'/75729972') }}'"
                                        data-info="{{$item['id']}},{{$item['platform_name']}}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </button>
                                    {{-- <button class="delete-modal btn btn-danger"
                                    onclick="window.location='{{ url('/6462/'.$item['id'].'/75729976') }}'"
                                        data-info="{{$item['id']}},{{$item['platform_name']}}">
                                        <span class="glyphicon glyphicon-trash"></span> Delete
                                    </button> --}}
                                    <button type="button" class="btn btn-danger button-delete" data-toggle="modal" data-target="#modal-danger" data-delete-link="{{ route('platform.destroy', $item['id']) }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Platform Code</th>
                        <th>Platform Name</th>
                        <th>Total Agency</th>
                        <th>Total Host</th>
                        <th>Platform Status</th>
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
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
 
            // https://datatables.net/forums/discussion/46832/toggle-button-not-work-on-page-2-and-so-on-how-can-i-fix-it
            // https://live.datatables.net/noyivopo/1/edit
            rowCallback: function ( row, data ) {
                $('input.changeplatformstatus', row).bootstrapToggle({
                    // size: 'mini'
                });
            }
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $(".button-delete").on('click', function () {
            // alert($(this).data('delete-link'));
            $('#delete-button-confirm').attr('action', $(this).data('delete-link'));
        });

        // https://makitweb.com/how-to-add-toggle-button-in-datatables-with-jquery-php/
        $('#example1').on('change','.changeplatformstatus',function(e){
        
            // alert(this.checked);
            // if (confirm("Are you sure?") == true) {
                var id = $(this).attr('data-id');
                var status = 0;
                if($(this).is(":checked")){
                    status = 1;
                }

                $.ajax({
                    url: '{{url("6462/75729977")}}',
                    type: 'post',
                    data: {"_token": "{{ csrf_token() }}",desc: 'changeStatus',status: status,id: id},
                    success: function(response) {
                    },
                    error: function() {
                    }
                });
            // }else{
            //     e.preventDefault();
            // }

        });
    });
  </script>