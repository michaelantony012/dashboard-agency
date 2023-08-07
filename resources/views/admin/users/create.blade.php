

@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Create User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
            <li class="breadcrumb-item active">Create User</li>
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
            {{-- <h3 class="card-title">Quick Example</h3> --}}
            </div>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="exampleInputName1">User Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name" name="name" required>
                        </div>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="exampleInputEmail1">User Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" required>
                        </div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="New password" name="password" required>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label>Access Level for User (you can select more than 1)</label>
                            <div class="select2-purple">
                                <select class="select2" multiple="multiple" data-placeholder="" data-dropdown-css-class="select2-purple" style="width: 100%;" name="level_access[]" required>
                                    <option>Admin</option>
                                    <option>Agency</option>
                                </select>
                            </div>
                        </div>
                        @error('level_access')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label>Agency</label>
                            <select class="form-control select2" style="width: 100%;" name="agency_id">
                                <option></option>
                                @foreach($agency as $agent)
                                    <option value="{{ $agent['id'] }}">{{ $agent['agency_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('agency_id')
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