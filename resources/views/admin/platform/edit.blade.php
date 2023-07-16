

@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Agency</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('agency.index') }}">Agency</a></li>
            <li class="breadcrumb-item active">Edit Agency</li>
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
            <form method="POST" action="{{ url('/6462/75728975') }}">
                @csrf
                <div class="card-body">
                    
                <div class="card-body">
                    
                    <div class="row">
                        <div class="form-group col">
                            <label for="id">Platform Code</label>
                            <input type="text" class="form-control" id="id" placeholder="auto generated" name="id" readonly value="{{ $id }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="platform_name">Platform Name</label>
                            <input type="text" class="form-control" id="platform_name" placeholder="Enter Platform Name" name="platform_name" required value="{{ $platform_name }}">
                        </div>
                        @error('platform_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="platform_status">Platform Status</label>
                            <select class="form-control select2" style="width: 100%;" name="platform_status">=
                                    <option value="1" @if ($platform_status == 1)
                                    selected
                                @endif>True</option>
                                    <option value="0" @if ($platform_status == 0)
                                    selected
                                @endif>False</option>=
                            </select>
                        </div>
                        @error('platform_status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> --}}
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