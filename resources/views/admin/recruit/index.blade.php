

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
                        <th style="width: 120px;">Recruit Number</th>
                        <th>Platform Name</th>
                        <th>Agency Name</th>
                        <th style="width:100px;">Recruit Status</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($data['data_modal'] as $item)
                            <tr>
                                <td>{{$item['id']}}</td>
                                <td>{{$item['platform_name']}}</td>
                                <td>{{$item['agency_name']}}</td>
                                {{-- <td>{{$item['recruit_status']}}</td> --}}
                                <td>
                                    <input type="checkbox" {{ $item['recruit_status_toggle'] }} class="changerecruitstatus" data-toggle="toggle"  data-id="{{ $item['id'] }}">
                                    {{-- <label class="switch">
                                        <input type="checkbox" '.$checked.' class="changeuserstatus" data-id="'.$empid.'" >
                                        <span class="slider round"></span>
                                    </label> --}}
                                </td>   
                                {{-- <td>
                                    <button class="edit-modal btn btn-info"
                                    onclick="window.location='{{ url('/6462/'.$item['id'].'/75721072') }}'"
                                        data-info="{{$item['id']}},{{$item['recruit_status']}}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit
                                    </button>
                                    
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Recruit Number</th>
                        <th>Platform Name</th>
                        <th>Agency Name</th>
                        <th>Recruit Status</th>
                        {{-- <th>Actions</th> --}}
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
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
 
            // https://datatables.net/forums/discussion/46832/toggle-button-not-work-on-page-2-and-so-on-how-can-i-fix-it
            // https://live.datatables.net/noyivopo/1/edit
            rowCallback: function ( row, data ) {
                $('input.changerecruitstatus', row).bootstrapToggle({
                    // size: 'mini'
                });
            }
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        // https://makitweb.com/how-to-add-toggle-button-in-datatables-with-jquery-php/
        $('#example1').on('change','.changerecruitstatus',function(e){
        

            // alert(this.checked);
            // if (confirm("Are you sure?") == true) {
                var id = $(this).attr('data-id');
                var status = 0;
                if($(this).is(":checked")){
                    status = 1;
                }

                $.ajax({
                    url: '{{url("6462/75721074")}}',
                    type: 'post',
                    data: {"_token": "{{ csrf_token() }}",desc: 'changeStatus',status: status,id: id},
                    success: function(response) {
                        if (response.status === 'inactive') {
                            alert('The Platform is not yet Activated');
                            // Uncheck the checkbox since we are not activating the Recruit
                            $('.changerecruitstatus[data-id="' + id + '"]').bootstrapToggle('off');

                        }
                    },
                    error: function() {
                        alert('Error occurred while checking Platform status.');
                    }
                });
            // }else{
            //     e.preventDefault();
            // }

        });
    });
  </script>