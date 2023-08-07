

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
            @if(session('alert'))
                <div class="alert alert-danger">
                    {{ session('alert') }}
                </div>
            @endif
            <form method="POST" action="{{ url('/6462/'.$id.'/75721173') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="host_uid">Host UID</label>
                            <input type="text" class="form-control" id="host_uid" placeholder="Host UID" name="host_uid" required value="{{ old('host_uid',$host_uid) }}">
                        </div>
                        @error('host_uid')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="host_name">Host Name</label>
                            <input type="text" class="form-control" id="host_name" placeholder="Host Name" name="host_name" required value="{{ old('host_name',$host_name) }}">
                        </div>
                        @error('host_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label>Platform</label>
                            <select class="form-control select2" style="width: 100%;" name="platform_id" id="platform_id" required>
                                @foreach($platform as $plat)
                                    <option></option>
                                    <option value="{{ $plat['platform_id'] }}"
                                    @if (old('platform_id'))
                                        @if(old('platform_id')==$plat['platform_id'])
                                            selected
                                        @endif
                                    @else
                                        @if ($platform_id == $plat['platform_id'])
                                            selected
                                        @endif
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

    })
</script>