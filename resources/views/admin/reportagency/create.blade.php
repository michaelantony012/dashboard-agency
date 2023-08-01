

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
                            <label for="report_period">Report Period Type</label>
                            <select class="form-control select2" style="width: 100%;" name="report_period" required id="report_period">
                                <option value="1">Weekly</option>
                                <option value="2">Monthly</option>
                            </select>
                        </div>
                        @error('report_period')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="report_weekmonth">Report Week / Month</label>
                            <input type="number" class="form-control" id="report_weekmonth" placeholder="Report Week / Month" name="report_weekmonth" required min="1" max="12">
                        </div>
                        @error('report_weekmonth')
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
                            <label>Agency</label>
                            <select class="form-control select2" style="width: 100%;" name="agency_id" required>
                                <option></option>
                                @foreach($agency as $agent)
                                    <option value="{{ $agent['id'] }}">{{ $agent['agency_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('agency_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label>Platform</label>
                            <select class="form-control select2" style="width: 100%;" name="platform_id" required>
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
                            <label for="percentage_share">Percentage Share</label>
                            <input type="number" class="form-control" id="percentage_share" placeholder="Percentage Share" name="percentage_share" step=".01" required>
                        </div>
                        @error('percentage_share')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label for="upload_detail">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="upload_detail" class="custom-file-input" id="upload_detail">
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

    // // Function to parse the date in the format "YYYY-MM-DD" to a Date object
    // function parseDate(dateString) {
    //     return moment(dateString, 'YYYY-MM-DD').toDate();
    // }
    // Function to parse the date in the format "YYYY-MM-DD" to a Date object
    function parseDate(dateString) {
        const dateParts = dateString.split('/');
        const year = parseInt(dateParts[2]);
        const month = parseInt(dateParts[1]) - 1; // Month is zero-based
        const day = parseInt(dateParts[0]);
        return new Date(year, month, day);
    }

    function updateReportFields() {
            // alert($('input[name="report_startdate"]').val());
            const startDate = parseDate($('input[name="report_startdate"]').val());
            const endDate = parseDate($('input[name="report_enddate"]').val());
            const diffInDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
            // alert(diffInDays);

            if(startDate <= endDate)
            {
                // Update the report_period field
                $('#report_period').val(diffInDays < 8 ? 1 : 2).trigger('change');

                // Update the report_weekmonth field
                const reportPeriod = $('#report_period').val();
                if (reportPeriod === '1') {
                    // // Calculate the week of the month based on the endDate
                    // const firstDayOfMonth = new Date(endDate.getFullYear(), endDate.getMonth(), 1);
                    // const daysOffset = firstDayOfMonth.getDay() === 0 ? 1 : 0;
                    // const weekOfMonth = Math.ceil((endDate.getDate() + daysOffset) / 7);
                    // $('#report_weekmonth').val(weekOfMonth);const weekOfMonth = 0;

                    const monthOfStartDate = startDate.getMonth();
                    const monthOfEndDate = endDate.getMonth();
                    const dateOfStartDate = startDate.getDate();
                    const dateOfEndDate = endDate.getDate();
                    if(monthOfStartDate == monthOfEndDate)
                    {
                        weekOfMonth = Math.ceil(dateOfStartDate/7);
                    }
                    else
                    {
                        if(dateOfEndDate>=4 && dateOfEndDate<=7)
                        {
                            weekOfMonth = 1;
                        }
                        else
                        {
                            weekOfMonth = Math.ceil(dateOfStartDate/7);
                        }
                    }
                    $('#report_weekmonth').val(weekOfMonth);

                } else {
                    // Set the month of the year based on the endDate
                    $('#report_weekmonth').val(endDate.getMonth() + 1);
                }
            }
        }

        // Trigger the updateReportFields function when the start or end date changes
        // Trigger the updateReportFields function when the datepicker is hidden
        $('#report_startdate, #report_enddate').on('change.datetimepicker', function() {
            // alert('a');
            updateReportFields();
        });

        // Initial call to updateReportFields when the page loads
        updateReportFields();

    // $('#report_startdate').change(function(){ // on change
    //     alert('a');
    //     // let date = new Date($(this).val());
    //     // let newDate = addDays(date, 6);
    //     // var formatted = newDate.toISOString().split('T')[0]; //yyyy-mm-dd
    //     // console.log(formatted);
    //     // $('#report_enddate').val(formatted);
    //  });
    // $('#report_startdate').on('dp.change', function(e){ 
    //     alert('bb');
    // })

    // // // $('#report_startdate').on('change.datetimepicker', function (e) {
            
    // // //         const startDate = moment(e.date);
    // // //         const endDate = moment($('#report_enddate'));
    // // //         alert(endDate);

    // // //         /* auto add 6 days to end date
    // // //         const endDate = startDate.clone().add(6, 'days');

    // // //         // Format the date as YYYY-MM-DD for the input field
    // // //         const endDateFormatted = endDate.format('DD/MM/YYYY');

    // // //         // Set the date using the datetimepicker API
    // // //         $('#report_enddate').datetimepicker('date', endDateFormatted);
    // // //         */

    // // //         // Calculate the difference in milliseconds between the two dates
    // // //         const dateDiff = endDate - startDate;
    // // //         const oneDay = 24 * 60 * 60 * 1000;

    // // //         // Calculate the difference in days between the two dates
    // // //         const diffDays = Math.round(dateDiff / oneDay);

    // // //         // Determine if it's a Week or a Month based on the difference in days
    // // //         const weekOrMonth = diffDays <= 7 ? "1" : "2";

    // // //         // Set the value in the Week/Month input field
    // // //         $('#report_period').val(weekOrMonth).trigger('change');
    // // // });

    
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4',
        placeholder: "Please select"
    });
    // // select 2 readonly by Name
    // $("select[name*='platform_id']").select2({
    //   disabled: true
    // });
})
</script>
