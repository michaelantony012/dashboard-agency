<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agency;
use App\Models\Platform;
use Illuminate\Support\Str;
use App\Models\ReportAgency;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ReportExtraction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ReportAgencyExtraction;
use App\Imports\ImportReportAgencyExtraction;
use App\Exports\ExportReportAgencyExtractionTemplate;

class ReportAgencyController extends Controller
{
    
    public function index()
    {
        if (str_contains( auth()->user()->level_access, 'Admin'))
        {
            $modal = DB::table('tb_report')
            ->leftJoin('tb_platform', 'tb_report.platform_id', '=', 'tb_platform.id')
            ->leftJoin('tb_agency', 'tb_report.agency_id', '=', 'tb_agency.id')
            ->select('tb_report.id', 'tb_report.report_period', 'tb_report.report_code', 'tb_report.report_weekmonth', 'tb_report.report_startdate', 'tb_report.report_enddate', 'tb_platform.platform_name', 'tb_agency.agency_name')
            ->get();
        } else
        {
            $modal = DB::table('tb_report')
            ->leftJoin('tb_platform', 'tb_report.platform_id', '=', 'tb_platform.id')
            ->leftJoin('tb_agency', 'tb_report.agency_id', '=', 'tb_agency.id')
            ->select('tb_report.id', 'tb_report.report_period', 'tb_report.report_code', 'tb_report.report_weekmonth', 'tb_report.report_startdate', 'tb_report.report_enddate', 'tb_platform.platform_name', 'tb_agency.agency_name')
            ->where('tb_report.agency_id', '=', auth()->user()->agency_id)
            ->get();
        }
        // dd($modasl);
        $data_modal = [];
        foreach(json_decode($modal, true) as $item)
        {
            $subarray=[];
            $subarray['id'] = $item['id'];
            $subarray['report_code'] = $item['report_code'];
            $subarray['report_weekmonth'] = $item['report_weekmonth'];
            $subarray['report_period'] = ($item['report_period']==1?"Weekly" : "Monthly");
            
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
        $agency_one = Agency::find($modal->agency_id);
        $platform_one = Platform::find($modal->platform_id);
        $agency = Agency::all();
        $platform = Platform::all();
        // dd('id: '.$id);

        // data extraction
        $extraction = DB::table('tb_extraction') // perlu diperbaiki
        // ->leftJoin('tb_platform', 'tb_extraction.platform_id', '=', 'tb_platform.id')
        // ->leftJoin('tb_agency', 'tb_extraction.agency_id', '=', 'tb_agency.id')
        // ->leftJoin('tb_host', 'tb_extraction.host_id', '=', 'tb_host.id')
        ->select('tb_extraction.id', 'tb_extraction.report_order', 'tb_extraction.report_id', 'tb_extraction.report_code', 'tb_extraction.platform_name', 'tb_extraction.platform_id', 'tb_extraction.agency_name', 'tb_extraction.agency_id', 'tb_extraction.host_uid', 'tb_extraction.host_id', 'tb_extraction.total_salary')
        ->where('report_id', $id)
        ->get();
        $extraction_result = json_decode($extraction, true);
        // dd($extraction_result);
        $extraction_array = [];
        foreach($extraction_result as $ext)
        {
            $ext['platform_found_status'] = $ext['platform_id']!=null?"OK":"Not Found";
            $ext['agency_found_status'] = $ext['agency_id']!=null?"OK":"Not Found";
            $ext['host_found_status'] = $ext['host_id']!=null?"OK":"Not Found";
            $extraction_array[] = $ext;
        }
        // dd($extraction_array);

        $data = [
            'title' => str_contains( auth()->user()->level_access, 'Admin')?'Edit Report Agency':'View Report Agency',
            'id' => $id,
            'report_code' => $modal->report_code,
            'report_weekmonth' => $modal->report_weekmonth,
            'report_period' => $modal->report_period,
            'report_startdate' => Carbon::createFromFormat('Y-m-d', $modal->report_startdate)->format('d/m/Y'),
            'report_enddate' => Carbon::createFromFormat('Y-m-d', $modal->report_enddate)->format('d/m/Y'),
            'agency_id' => $modal->agency_id,
            'agency_name' => $agency_one->agency_name,
            'platform_id' => $modal->platform_id,
            'platform_name' => $platform_one->platform_name,
            'percentage_share' => $modal->percentage_share,
            'agency' => $agency,
            'platform' => $platform,
            'extraction' => $extraction_array,
            'total_paidhost' => number_format($modal->total_paidhost,0),
            'total_salary' => number_format($modal->total_salary,2),
            'total_share' => number_format($modal->total_share,2)
        ];
        return view('admin.reportagency.edit', $data);
    }
    public function update(Request $request, $id)
    {
        // dd('name: '.$request->name.', email: '.$request->email.', password: '.Hash::make($request->password));
        $result = json_encode($request);
        // dd($result);

        $request->validate([
            // 'report_code' => 'required',
            'report_period' => 'required',
            'report_weekmonth' => 'required',
            'report_startdate' => 'required',
            'report_enddate' => 'required',
            'agency_id' => 'required',
            'platform_id' => 'required',
            'percentage_share' => 'required'
        ]);

        ReportAgency::where('id', $id)
        ->update([
            // 'report_code' => $request->report_code,
            'report_period' => $request->report_period,
            'report_weekmonth' => $request->report_weekmonth,
            'report_startdate' => Carbon::createFromFormat('d/m/Y', $request->report_startdate)->format('Y-m-d'),
            'report_enddate' => Carbon::createFromFormat('d/m/Y', $request->report_enddate)->format('Y-m-d'),
            'agency_id' => $request->agency_id,
            'platform_id' => $request->platform_id,
            'percentage_share' => $request->percentage_share
            // total_paidhost
            // total_salary
            // total_share
        ]);
        
        $report = ReportAgency::find($id);
        // dd($report->report_code);
        // dd($request->file('upload_detail'));

        if($request->file('upload_detail'))
        {
            $delete_extraction = ReportExtraction::where('report_id', $report->id)->delete();
            request()->validate([
                'upload_detail' => 'mimes:xlsx,xls|max:2048'
                // 'upload_detail' => 'required|mimes:xlsx,xls|max:2048'
            ]);
            Excel::import(new ImportReportAgencyExtraction($report->report_code, $report->id), $request->file('upload_detail'));

        }
        // summary columns header
        $report_agency = ReportAgency::find($id);
        $count_host = DB::table('tb_extraction')->where('report_id', $id)->select('id')->count();
        $sum_salary = DB::table('tb_extraction')->where('report_id', $id)->sum('total_salary');
        if($count_host>0)
        {
            ReportAgency::where('id', $id)->update(['total_paidhost' => $count_host]);
        }
        if($sum_salary>0)
        {
            ReportAgency::where('id', $id)->update(['total_salary' => $sum_salary, 'total_share' => ($sum_salary * ($report_agency->percentage_share/100))]);
        }

        return redirect()->route('reportagency.edit', [$report->id])->with('success', 'Successfully Update Data');
    }
    public function create()
    {
        $agency = Agency::all();
        $platform = Platform::where('platform_status', '=', '1')->get();
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
            'report_period' => 'required',
            'report_weekmonth' => 'required',
            'report_startdate' => 'required',
            'report_enddate' => 'required',
            'agency_id' => 'required',
            'platform_id' => 'required',
            'percentage_share' => 'required'
        ]);

        $agency = Agency::find($request->agency_id);
        $platform = Platform::find($request->platform_id);
        // dd($request->report_startdate);
        // dd($platform->id);
        // dd($agency->id);
        // dd("0".$request->report_week);
        // dd(substr("0".$request->report_week, -2));
        $report_code = substr("0".$request->report_enddate, 9,2).substr("0".$request->report_enddate, 4,2).(string)($request->report_period==1?"W":"M").substr("0".$request->report_weekmonth, -2).'/'.$platform->id.'/'.$agency->id;
        // dd($report_code);
        $report = ReportAgency::create([
            'report_code' => $report_code,
            'report_period' => $request->report_period,
            'report_weekmonth' => $request->report_weekmonth,
            'report_startdate' => Carbon::createFromFormat('d/m/Y', $request->report_startdate)->format('Y-m-d'),
            'report_enddate' => Carbon::createFromFormat('d/m/Y', $request->report_enddate)->format('Y-m-d'),
            'agency_id' => $request->agency_id,
            'platform_id' => $request->platform_id,
            'percentage_share' => $request->percentage_share
            // total_paidhost
            // total_salary
            // total_share  
        ]);

        if($request->file('upload_detail'))
        {
            $delete_extraction = ReportExtraction::where('report_id', $report->id)->delete();
            request()->validate([
                // 'upload_detail' => 'required|mimes:xlsx,xls|max:2048'
                'upload_detail' => 'mimes:xlsx,xls|max:2048'
            ]);
            Excel::import(new ImportReportAgencyExtraction($report->report_code, $report->id), $request->file('upload_detail'));
        }
        // summary columns header
        $id = $report->id;
        $report_agency = ReportAgency::find($id);
        $count_host = DB::table('tb_extraction')->where('report_id', $id)->select('id')->count();
        $sum_salary = DB::table('tb_extraction')->where('report_id', $id)->sum('total_salary');
        if($count_host>0)
        {
            ReportAgency::where('id', $id)->update(['total_paidhost' => $count_host]);
        }
        if($sum_salary>0)
        {
            ReportAgency::where('id', $id)->update(['total_salary' => $sum_salary, 'total_share' => ($sum_salary * ($report_agency->percentage_share/100))]);
        }

        return redirect()->route('reportagency.edit', [$report->id])->with('success', 'Successfully Create New Report');
    }
    public function destroy($id)
    {
        // dd($id);
        DB::delete('delete from tb_report where id = ?', [$id]);

        return redirect()->route('reportagency.index')->with('success', 'Successfully Delete Report');
    }
}
