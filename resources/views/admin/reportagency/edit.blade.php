

@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">
            @if (str_contains( auth()->user()->level_access, 'Admin'))
            Edit Report
            @else
            View Report
            @endif</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('reportagency.index') }}">Report Agency</a></li>
            <li class="breadcrumb-item active">
                @if (str_contains( auth()->user()->level_access, 'Admin'))
                Edit Report
                @else
                View Report
                @endif
            </li>
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
            <form method="POST" action="{{ url('/6462/'.$id.'/75727973') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="report_code">Report Code</label>
                            <input type="text" class="form-control" id="report_code" placeholder="auto generated" name="report_code" required value="{{ $report_code }}" readonly>
                        </div>
                        @error('report_code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label>Report Periode Type</label>
                            @if (str_contains( auth()->user()->level_access, 'Admin'))
                            <select class="form-control select2" style="width: 100%;" name="report_period" id="report_period">
                                <option value="1" 
                                    @if ($report_period == 1)
                                        selected
                                    @endif
                                >Weekly</option>
                                <option value="2" 
                                @if ($report_period == 2)
                                    selected
                                @endif
                                >Monthly</option>
                            </select>
                            @else
                            <input type="text" class="form-control" id="report_period" name="report_period" value="{{ $report_period==1?"Weekly" : "Monthly" }}" readonly>
                            @endif
                        </div>
                        @error('agency_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="report_weekmonth">Report Week / Month</label>
                            <input type="number" class="form-control" id="report_weekmonth" placeholder="Report Week / Month" name="report_weekmonth" required value="{{ $report_weekmonth }}" min="1" max="12" 
                            @if (!str_contains( auth()->user()->level_access, 'Admin'))
                                readonly
                            @endif
                            >
                        </div>
                        @error('report_weekmonth')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label>Report Start Date</label>
                            @if (str_contains( auth()->user()->level_access, 'Admin'))
                            <div class="input-group date" id="report_startdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#report_startdate" name="report_startdate" required value="{{ $report_startdate }}"/>
                                <div class="input-group-append" data-target="#report_startdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            </div>
                            @else
                            <input type="text" class="form-control" value="{{ $report_startdate }}" readonly>
                            @endif
                        </div>
                        @error('report_startdate')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label>Report End Date</label>
                            @if (str_contains( auth()->user()->level_access, 'Admin'))
                            <div class="input-group date" id="report_enddate" data-target-input="nearest">
                                <input type="text" id="1234" class="form-control datetimepicker-input" data-target="#report_enddate" name="report_enddate" required value="{{ $report_enddate }}"/>
                                <div class="input-group-append" data-target="#report_enddate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            </div>
                            @else
                            <input type="text" class="form-control" value="{{ $report_enddate }}" readonly>
                            @endif
                        </div>
                        @error('report_enddate')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @if (str_contains( auth()->user()->level_access, 'Admin'))
                        <div class="form-group col">
                            <label>Agency</label>
                            <select class="form-control select2" style="width: 100%;" name="agency_id">
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
                        @endif
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="percentage_share">Percentage Share</label>
                            <input type="number" class="form-control" id="percentage_share" placeholder="Percentage Share" name="percentage_share" step=".01" required value="{{ $percentage_share }}"
                            @if (!str_contains( auth()->user()->level_access, 'Admin'))
                                readonly
                            @endif
                            >
                        </div>
                        @error('percentage_share')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group col">
                            <label>Select Platform</label>
                            @if (str_contains( auth()->user()->level_access, 'Admin'))
                            <select class="form-control select2" style="width: 100%;" name="platform_id">
                                @foreach($platform as $plat)
                                    <option></option>
                                    <option value="{{ $plat['id'] }}"
                                    @if ($platform_id == $plat['id'])
                                        selected
                                    @endif
                                    >{{ $plat['platform_name'] }}</option>
                                @endforeach
                            </select>
                            @else
                            <input type="text" class="form-control" id="platform_id" name="platform_id" value="{{ $platform_name }}" readonly>
                            @endif
                        </div>
                        @error('platform_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="total_paidhost">Total Paid Host</label>
                            <input type="text" class="form-control" id="total_paidhost" placeholder="Total Paid Host" name="total_paidhost" step=".01" readonly value="{{ number_format($total_paidhost) }}">
                        </div>
                        <div class="form-group col">
                            <label for="total_salary">Total Salary</label>
                            <input type="text" class="form-control" id="total_salary" placeholder="Total Salary" name="total_salary" readonly value="{{ $total_salary }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="total_share">Total Share</label>
                            <input type="text" class="form-control" id="total_share" placeholder="Total Share" name="total_share" readonly value="{{ $total_share }}">
                        </div>
                        @if (str_contains( auth()->user()->level_access, 'Admin'))
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
                        @endif
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

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            {{-- <th style="width: 15px">#Report ID</th>
                            <th style="width: 10px">#ID</th> --}}
                            <th>Report Order</th>
                            {{-- <th>Report Code</th>
                            <th>Platform Name</th>
                            <th>>Status</th>
                            <th>Agency Name</th>
                            <th>>Status</th> --}}
                            <th>Host UID</th>
                            {{-- <th>>Status</th> --}}
                            <th>Total Salary</th>
                            {{-- <th style="width: 40px">Label</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($extraction as $ext)
                    <tr>
                        {{-- <td>{{ $ext['report_id'] }}</td>
                        <td>{{ $ext['id'] }}</td> --}}
                        <td style="width: 200px">{{ $ext['report_order'] }}</td>
                        {{-- <td>{{ $ext['report_code'] }}</td>
                        <td>{{ $ext['platform_name'] }}</td>
                        <td>{{ $ext['platform_found_status'] }}</td>
                        <td>{{ $ext['agency_name'] }}</td>
                        <td>{{ $ext['agency_found_status'] }}</td> --}}
                        <td>{{ $ext['host_uid'] }}</td>
                        {{-- <td>{{ $ext['host_found_status'] }}</td> --}}
                        <td>{{ number_format($ext['total_salary'],2) }}</td>
                    </tr>
                    @endforeach
                        
                        {{-- <tr>
                            <td>2.</td>
                            <td>Clean database</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-warning" style="width: 70%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-warning">70%</span></td>
                        </tr> --}}
                    </tbody>
                </table>

                @if (str_contains( auth()->user()->level_access, 'Admin'))
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                @endif
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
        //Initialize Select2 Elements
        $('.select2').select2({
        theme: 'bootstrap4',
            placeholder: "Please select"
        });
        // date
        $('#report_startdate').datetimepicker({
            format: 'DD/MM/YYYY',
            // defaultDate: dateNow
        });
        $('#report_enddate').datetimepicker({
            format: 'DD/MM/YYYY',
            // defaultDate: dateLater
        });
        
        /*
        $('#report_startdate').on('change.datetimepicker', function (e) {
            // alert('b');
            const startDate = moment(e.date);
            // alert(startDate);
            const endDate = startDate.clone().add(6, 'days');
            // alert(endDate);

            // Format the date as YYYY-MM-DD for the input field
            const endDateFormatted = endDate.format('DD/MM/YYYY');
            // alert(endDateFormatted);

            // Set the date using the datetimepicker API
            $('#report_enddate').datetimepicker('date', endDateFormatted);

            // // Trigger the 'change' event manually to make sure the value is updated
            // $('#report_enddate').trigger('change');
        });
        */


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
                    // $('#report_weekmonth').val(weekOfMonth);

                    const weekOfMonth = 0;
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
        // updateReportFields();
    })
</script>