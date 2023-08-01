

@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Host</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('host.index') }}">Host</a></li>
            <li class="breadcrumb-item active">Edit Host</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Fill Data</h3>
            </div>
            <form method="POST" action="{{ url('/6462/'.$id.'/75721173') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="host_uid">Host UID</label>
                            <input type="text" class="form-control" id="host_uid" placeholder="Host UID" name="host_uid" required readonly value="{{ $host_uid }}">
                        </div>
                        @error('host_uid')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="host_name">Host Name</label>
                            <input type="text" class="form-control" id="host_name" placeholder="Host Name" name="host_name" required value="{{ $host_name }}">
                        </div>
                        @error('host_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label>Agency</label>
                            <select class="form-control select2" style="width: 100%;" name="agency_id" id="agency_id" required>
                                <option></option>
                                @foreach($agency as $agent)
                                    <option value="{{ $agent['id'] }}" 
                                        @if ($agency_id == $agent['id'])
                                            selected
                                        @endif
                                    >{{ $agent['agency_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('agency_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label>Platform</label>
                            <select class="form-control select2" style="width: 100%;" name="platform_id" id="platform_id" required>
                                @foreach($platform as $plat)
                                    <option></option>
                                    <option value="{{ $plat['platform_id'] }}"
                                    @if ($platform_id == $plat['platform_id'])
                                        selected
                                    @endif
                                    >{{ $plat['platform_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('platform_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>  
@endsection

<!-- jQuery -->
<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2({
        theme: 'bootstrap4',
            placeholder: "Please select"
        });

        // Set up filtering based on the selection in the first Select2
        $('#agency_id').on('change', function () {
            var agencyId = $(this).val();

            // Clear the existing options in the content Select2
            $('#platform_id').empty();

            // Select Agency first -> Shows PLatform based on Recruit (agency_id) where recruit_status=1
            // Fetch the filtered content options based on the filterValue using AJAX or any other method
            // For example, if you want to fetch the options from a Laravel controller, you can use AJAX like this:
            $.ajax({
                url: '{{url("6462/75721177")}}',
                type: 'post',
                data: {"_token": "{{ csrf_token() }}",agency_id: agencyId},
                success: function (data) {
                    // Loop through the fetched data and add options to the content Select2
                    $.each(data, function (index, option) {
                        $('#platform_id').append($('<option></option>').attr('value', option.platform_id).text(option.platform_name));
                    });

                    // Trigger the change event on the content Select2 to update its UI
                    $('#platform_id').trigger('change');
                },
                error: function (error) {
                    // Handle errors, if any
                    console.log(error);
                }
            });
        });

    })
</script>