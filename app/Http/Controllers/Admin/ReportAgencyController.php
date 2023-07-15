<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agency;
use App\Models\Platform;
use App\Models\ReportAgency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Imports\ImportReportAgencyExtraction;
use App\Exports\ExportReportAgencyExtractionTemplate;
use Maatwebsite\Excel\Facades\Excel;

class ReportAgencyController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Report'
        ];
        $data1 = ReportAgency::all();
        return view('admin.reportagency.index')->withData($data1);
    }
    public function edit($id)
    {
        $modal = ReportAgency::find($id);
        $agency = Agency::all();
        $platform = Platform::all();
        // dd('id: '.$id);
        $data = [
            'id' => $id,
            'report_code' => $modal->report_code,
            'report_week' => $modal->report_week,
            'report_startdate' => $modal->report_startdate,
            'report_enddate' => $modal->report_enddate,
            'agency_id' => $modal->agency_id,
            'platform_id' => $modal->platform_id,
            'percentage_share' => $modal->percentage_share,
            'agency' => $agency,
            'platform' => $platform
            // total_paidhost
            // total_salary
            // total_share
        ];
        return view('admin.reportagency.edit', $data);
    }
    public function update(Request $request)
    {
        // dd('name: '.$request->name.', email: '.$request->email.', password: '.Hash::make($request->password));
        $result = json_encode($request);
        dd($result);

        ReportAgency::where('id', $request->id)
        ->update([
            'report_code' => $request->report_code,
            'report_week' => $request->report_week,
            'report_startdate' => $request->report_startdate,
            'report_enddate' => $request->report_enddate,
            'agency_id' => $request->agency_id,
            'platform_id' => $request->platform_id,
            'percentage_share' => $request->percentage_share
            // total_paidhost
            // total_salary
            // total_share
        ]);

        return redirect()->route('reportagency.index')->with('success', 'Successfully Update User');
    }
    public function create()
    {
        $agency = Agency::all();
        $platform = Platform::all();
        $data = [
            'title' => 'Create Report',
            'agency' => $agency,
            'platform' => $platform
        ];
        return view('admin.reportagency.create', $data);
    }
    public function store(Request $request)
    {
        // $result = json_decode($request);
        // dd($request);

        // $request->validate([
        //     'report_code' => 'required',
        //     'report_week' => 'required',
        //     'report_startdate' => 'required',
        //     'report_enddate' => 'required',
        //     'agency_id' => 'required',
        //     'platform_id' => 'required',
        //     'percentage_share' => 'required'
        // ]);

        // ReportAgency::create([
        //     'report_code' => $request->report_code,
        //     'report_week' => $request->report_week,
        //     'report_startdate' => $request->report_startdate,
        //     'report_enddate' => $request->report_enddate,
        //     'agency_id' => $request->agency_id,
        //     'platform_id' => $request->platform_id,
        //     'percentage_share' => $request->percentage_share
        //     // total_paidhost
        //     // total_salary
        //     // total_share
            
        // ]);

        request()->validate([
            'upload_detail' => 'required|mimes:xlsx,xls|max:2048'
        ]);
        Excel::import(new ImportReportAgencyExtraction, $request->file('upload_detail'));

        return redirect()->route('reportagency.index')->with('success', 'Successfully Create New Report');
    }
    public function destroy($id)
    {
        // DB::delete('delete from reportagency where id = ?', [$id]);

        return redirect()->route('reportagency.index')->with('success', 'Successfully Delete Report');
    }
}
