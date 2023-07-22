<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agency;
use App\Models\Recruit;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RecruitController extends Controller
{
    public function index()
    {
        $modal = DB::table('tb_recruit')
        ->leftJoin('tb_platform', 'tb_recruit.platform_id', '=', 'tb_platform.id')
        ->leftJoin('tb_agency', 'tb_recruit.agency_id', '=', 'tb_agency.id')
        ->select('tb_recruit.id', 'tb_recruit.recruit_status', 'tb_platform.platform_name', 'tb_agency.agency_name')
        ->get();
        $data_modal = [];
        foreach(json_decode($modal, true) as $item)
        {
            $subarray=[];
            $subarray['id'] = $item['id'];
            $subarray['recruit_status'] = $item['recruit_status']==1?"Active" : "Inactive";
            $subarray['platform_name'] = $item['platform_name'];
            $subarray['agency_name'] = $item['agency_name'];
            $data_modal[] = $subarray;
        }
        // dd($data_modal);
        $data = [
            'title' => 'Recruit',
            'data_modal' => $data_modal
        ];
        
        return view('admin.recruit.index', $data)->withData($data);
    }
    public function edit($id)
    {
        $modal = DB::table('tb_recruit')
        ->leftJoin('tb_platform', 'tb_recruit.platform_id', '=', 'tb_platform.id')
        ->leftJoin('tb_agency', 'tb_recruit.agency_id', '=', 'tb_agency.id')
        ->where('tb_recruit.id', '=', $id)
        ->select('tb_recruit.recruit_status', 'tb_platform.platform_name', 'tb_agency.agency_name')
        ->first();
        // dd('id: '.$id);
        $data = [
            'title' => 'Edit Recruit',
            'id' => $id,
            'platform_name' => $modal->platform_name,
            'agency_name' => $modal->agency_name,
            'recruit_status' => $modal->recruit_status
            // 'total_agency' => $modal->total_agency,
            // 'total_host' => $modal->total_host
        ];
        return view('admin.recruit.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $result = json_encode($request);

        $request->validate([
            'recruit_status' => 'required',
        ]);

        Recruit::where('id', '=', $request->id)
        ->update([
            'recruit_status' => $request->recruit_status
            // 'total_agency' => $modal->total_agency,
            // 'total_host' => $modal->total_host
        ]);

        // agency update total host
        $recruit = Recruit::find($id);
        $recruit_platform_count = DB::table('tb_recruit')
        ->select('tb_recruit.platform_id')
        ->where('agency_id', '=', $recruit->agency_id)
        ->where('recruit_status', '=', 1)
        ->count();

        // dd($recruit_platform_count);
        if($recruit_platform_count > 0)
        {
            Agency::where('id', $recruit->agency_id)
            ->update([
                'total_platform' => $recruit_platform_count
            ]);
        }

        // platform update total agency
        $recruit_agency_count = DB::table('tb_recruit')
        ->select('tb_recruit.agency_id')
        ->where('platform_id', '=', $recruit->platform_id)
        ->where('recruit_status', '=', 1)
        ->count();

        if($recruit_agency_count > 0)
        {
            Platform::where('id', $recruit->platform_id)
            ->update([
                'total_agency' => $recruit_agency_count
            ]);
        }

        return redirect()->route('recruit.index')->with('success', 'Successfully Update Recruit');
    }
}
