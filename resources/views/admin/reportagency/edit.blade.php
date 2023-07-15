

@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Edit User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
            <li class="breadcrumb-item active">Edit Users</li>
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
            <form method="POST" action="{{ url('/6462/75726973') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="report_code">Report Code</label>
                        <input type="text" class="form-control" id="report_code" placeholder="auto generated" name="report_code" value="{{ $report_code }}" required>
                    </div>
                    @error('report_code')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="report_week">Report Week</label>
                        <input type="number" class="form-control" id="report_week" placeholder="Report Week" name="report_week" value="{{ $report_week }}" required>
                    </div>
                    @error('report_week')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="report_startdate">Report Start Date</label>
                        <input type="text" class="form-control" id="report_startdate" placeholder="Report Start Date" name="report_startdate"  value="{{ $report_startdate }}"required>
                    </div>
                    @error('report_startdate')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="report_enddate">Report End Date</label>
                        <input type="text" class="form-control" id="report_enddate" placeholder="Report End Date" name="report_enddate" value="{{ $report_enddate }}" required>
                    </div>
                    @error('report_enddate')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="agency_id">Select Agency</label>
                        <input type="text" class="form-control" id="agency_id" placeholder="Agency" name="agency_id" value="{{ $agency_id }}" required>
                    </div>
                    @error('agency_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="platform_id">Select Platform</label>
                        <input type="text" class="form-control" id="platform_id" placeholder="Platform" name="platform_id" value="{{ $platform_id }}" required>
                    </div>
                    @error('platform_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="percentage_share">Enter Percentage Share</label>
                        <input type="text" class="form-control" id="percentage_share" placeholder="Percentage Share" name="percentage_share" value="{{ $percentage_share }}" required>
                    </div>
                    @error('percentage_share')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
