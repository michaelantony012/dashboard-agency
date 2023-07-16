<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agency;
use App\Models\Platform;
use App\Models\ReportAgency;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportReportAgencyExtraction;
use App\Exports\ExportReportAgencyExtractionTemplate;

class ReportAgencyController extends Controller
{
    
    public function index()
    {
        $modal = DB::table('tb_report')
        ->leftJoin('tb_platform', 'tb_report.platform_id', '=', 'tb_platform.id')
        ->leftJoin('tb_agency', 'tb_report.agency_id', '=', 'tb_agency.id')
        ->select('tb_report.id', 'tb_report.report_code', 'tb_report.report_week', 'tb_report.report_startdate', 'tb_report.report_enddate', 'tb_platform.platform_name', 'tb_agency.agency_name')
        ->get();
        // dd($modasl);
        $data_modal = [];
        foreach(json_decode($modal, true) as $item)
        {
            $subarray=[];
            $subarray['id'] = $item['id'];
            $subarray['report_code'] = $item['report_code'];
            $subarray['report_week'] = $item['report_week'];
            
            $startdate = Carbon::parse($item['report_startdate']);
            $enddate = Carbon::parse($item['report_enddate']);

            $subarray['report_startdate'] = $startdate->format('d M Y');
            $subarray['report_enddate'] = $enddate->format('d M Y');
            $subarray['agency_name'] = $item['agency_name'];
            $subarray['platform_name'] = $item['platform_name'];
            $data_modal[] = $subarray;
        }
        // dd($data_modal);
        $data = [
            'title' => 'Report Agency',
            'data_modal' => $data_modal
        ];
        
        return view('admin.reportagency.index', $data)->withData($data);
    }
    public function edit($id)
    {
        $modal = ReportAgency::find($id);
        $agency = Agency::all();
        $platform = Platform::all();
        // dd('id: '.$id);
        $data = [
            'title' => 'Edit Report Agency',
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
        // dd($result);

        $request->validate([
            // 'report_code' => 'required',
            'report_week' => 'required',
            'report_startdate' => 'required',
            'report_enddate' => 'required',
            'agency_id' => 'required',
            'platform_id' => 'required',
            'percentage_share' => 'required'
        ]);

        // ReportAgency::where('id', $request->id)
        // ->update([
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

        return redirect()->route('reportagency.index')->with('success', 'Successfully Update User');
    }
    public function create()
    {
        $agency = Agency::all();
        $platform = Platform::all();
        $data = [
            'title' => 'Create Report Agency',
            'agency' => $agency,
            'platform' => $platform
        ];
        return view('admin.reportagency.create', $data);
    }
    public function store(Request $request)
    {
        // $result = json_decode($request);
        // dd($request);

        $request->validate([
            // 'report_code' => 'required',
            'report_week' => 'required',
            'report_startdate' => 'required',
            'report_enddate' => 'required',
            'agency_id' => 'required',
            'platform_id' => 'required',
            'percentage_share' => 'required'
        ]);

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
