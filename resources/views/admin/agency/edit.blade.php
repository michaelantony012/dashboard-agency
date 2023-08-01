

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
            <form method="POST" action="{{ url('/6462/'.$id.'/75728973') }}">
                @csrf
                <div class="card-body">
                    
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="agency_name">Agency Name</label>
                            <input type="text" class="form-control" id="agency_name" placeholder="Agency Name" name="agency_name" required value="{{ $agency_name }}">
                        </div>
                        @error('agency_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="agency_bank">Agency Bank</label>
                            <input type="text" class="form-control" id="agency_bank" placeholder="Agency Bank" name="agency_bank" required value="{{ $agency_bank }}">
                        </div>
                        @error('agency_bank')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="agency_bank_id">Agency Bank ID</label>
                            <input type="text" class="form-control" id="agency_bank_id" placeholder="Agency Bank ID" name="agency_bank_id" required value="{{ $agency_bank_id }}">
                        </div>
                        @error('agency_bank_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="pic_idcard">PIC ID Card</label>
                            {{-- <input type="text" class="form-control" id="pic_idcard" placeholder="ID Card PIC" name="pic_idcard" required value="{{ $pic_idcard }}"> --}}
                            <input type="text" pattern="\d*" maxlength="16" class="form-control" id="pic_idcard" placeholder="ID Card PIC" name="pic_idcard" required value="{{ $pic_idcard }}">
                        </div>
                        @error('pic_idcard')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="pic_fullname">PIC Full Name</label>
                            <input type="text" class="form-control" id="pic_fullname" placeholder="PIC Full Name" name="pic_fullname" required value="{{ $pic_fullname }}">
                        </div>
                        @error('pic_fullname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="pic_phone">PIC Phone Number</label>
                            {{-- <input type="text" class="form-control" id="pic_phone" placeholder="PIC Phone Number" name="pic_phone" required value="{{ $pic_phone }}"> --}}
                            <input type="text" pattern="^\+62\d{10,}$" title="Please enter a valid phone number starting with +62 and containing 10 or more digits." class="form-control" id="pic_phone" placeholder="PIC Phone Number" name="pic_phone" required value="{{ $pic_phone }}">
                        </div>
                        @error('pic_phone')
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