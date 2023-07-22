

@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit Recruit</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('recruit.index') }}">Agency</a></li>
            <li class="breadcrumb-item active">Edit Recruit</li>
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
            <form method="POST" action="{{ url('/6462/'.$id.'/75721073') }}">
                @csrf
                <div class="card-body">
                    
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="agency_name">Agency Name</label>
                            <input type="text" class="form-control" id="agency_name" placeholder="Agency Name" name="agency_name" required value="{{ $agency_name }}" readonly>
                        </div>
                        @error('agency_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="platform_name">Platform Name</label>
                            <input type="text" class="form-control" id="platform_name" placeholder="Platform Name" name="platform_name" required value="{{ $platform_name }}" readonly>
                        </div>
                        @error('platform_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="recruit_status">Recruit Status</label>
                            <select class="form-control select2" style="width: 100%;" name="recruit_status">=
                                    <option value="1" @if ($recruit_status == 1)
                                    selected
                                @endif>Active</option>
                                    <option value="0" @if ($recruit_status == 0)
                                    selected
                                @endif>InActive</option>=
                            </select>
                        </div>
                        @error('recruit_status')
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