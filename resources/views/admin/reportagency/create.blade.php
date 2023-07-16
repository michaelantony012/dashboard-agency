

@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Create Report</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('reportagency.index') }}">Report Agency</a></li>
            <li class="breadcrumb-item active">Create Report</li>
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
            <form method="POST" action="{{ route('reportagency.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="report_code">Report Code</label>
                            <input type="text" class="form-control" id="report_code" placeholder="auto generated" name="report_code" readonly>
                        </div>
                        @error('report_code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="report_week">Report Week</label>
                            <input type="number" class="form-control" id="report_week" placeholder="Report Week" name="report_week" required>
                        </div>
                        @error('report_week')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label>Report Start Date</label>
                            <div class="input-group date" id="report_startdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#report_startdate" name="report_startdate" required/>
                                <div class="input-group-append" data-target="#report_startdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            </div>
                        </div>
                        @error('report_startdate')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label>Report End Date</label>
                            <div class="input-group date" id="report_enddate" data-target-input="nearest">
                                <input type="text" id="1234" class="form-control datetimepicker-input" data-target="#report_enddate" name="report_enddate" required/>
                                <div class="input-group-append" data-target="#report_enddate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            </div>
                        </div>
                        @error('report_enddate')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label>Select Agency</label>
                            <select class="form-control select2" style="width: 100%;" name="agency_id">
                                <option></option>
                                @foreach($agency as $agent)
                                    <option value="{{ $agent['id'] }}">{{ $agent['agency_name'] }}</option>
                                @endforeach

                                {{-- <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option> --}}
                            </select>
                        </div>
                        @error('agency_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label>Select Platform</label>
                            <select class="form-control select2" style="width: 100%;" name="platform_id">
                                @foreach($platform as $plat)
                                    <option></option>
                                    <option value="{{ $plat['id'] }}">{{ $plat['platform_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('platform_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="percentage_share">Enter Percentage Share</label>
                            <input type="number" class="form-control" id="percentage_share" placeholder="Percentage Share" name="percentage_share" step=".01" required>
                        </div>
                        @error('percentage_share')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="upload_detail">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="upload_detail" class="custom-file-input" id="upload_detail" required>
                                    <label class="custom-file-label" for="upload_detail">Choose file</label>
                                </div>
                                {{-- <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div> --}}
                            </div>
                        </div>
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
    //Custom File Input
    bsCustomFileInput.init();
    
    var dateNow = new Date();
    var dateLater = new Date();
    dateLater = dateLater.setDate(dateLater.getDate() + 6);
    //Date picker
    $('#report_startdate').datetimepicker({
        format: 'DD/MM/YYYY',
        defaultDate: dateNow
    });
    $('#report_enddate').datetimepicker({
        format: 'DD/MM/YYYY',
        defaultDate: dateLater
    });
    $('#report_startdate').change(function(){ // on change
        alert('a');
        // let date = new Date($(this).val());
        // let newDate = addDays(date, 6);
        // var formatted = newDate.toISOString().split('T')[0]; //yyyy-mm-dd
        // console.log(formatted);
        // $('#report_enddate').val(formatted);
     });
    // $('#report_startdate').on('dp.change', function(e){ 
    //     alert('bb');
    // })

    //Select2
    
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4',
        placeholder: "Please select"
    });
})
</script>
