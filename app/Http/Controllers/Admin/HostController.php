<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Host;
use Illuminate\Support\Facades\DB;
use App\Models\Agency;
use App\Models\Recruit;
use App\Models\Platform;

class HostController extends Controller
{
    public function index()
    {
        if (str_contains( auth()->user()->level_access, 'Admin'))
        {
            $modal = DB::table('tb_host')
            ->leftJoin('tb_platform', 'tb_host.platform_id', '=', 'tb_platform.id')
            ->leftJoin('tb_agency', 'tb_host.agency_id', '=', 'tb_agency.id')
            ->select('tb_host.id', 'tb_host.host_uid', 'tb_host.host_name', 'tb_platform.platform_name', 'tb_agency.agency_name')
            ->get();
        } else
        {
            $modal = DB::table('tb_host')
            ->leftJoin('tb_platform', 'tb_host.platform_id', '=', 'tb_platform.id')
            ->leftJoin('tb_agency', 'tb_host.agency_id', '=', 'tb_agency.id')
            ->select('tb_host.id', 'tb_host.host_uid', 'tb_host.host_name', 'tb_platform.platform_name', 'tb_agency.agency_name')
            ->where('tb_host.agency_id', '=', auth()->user()->agency_id)
            ->get();
        }
        $data_modal = [];
        foreach(json_decode($modal, true) as $item)
        {
            $subarray=[];
            $subarray['id'] = $item['id'];
            $subarray['host_uid'] = $item['host_uid'];
            $subarray['host_name'] = $item['host_name'];
            $subarray['platform_name'] = $item['platform_name'];
            $subarray['agency_name'] = $item['agency_name'];
            $data_modal[] = $subarray;
        }
        // dd($data_modal);
        $data = [
            'title' => 'Host',
            'data_modal' => $data_modal
        ];
        
        return view('admin.host.index', $data)->withData($data);
    }
    public function edit($id)
    {
        $modal = Host::where('id', $id)->first();

        if (str_contains( auth()->user()->level_access, 'Admin'))
        {
            $agency = Agency::all();
        }else {
            $agency = Agency::where('id', auth()->user()->agency_id)->get();
        }
        // dd($agency);
        // $platform = Platform::where('platform_status', '=', '1')->get();
        
        // // Select Agency first -> Shows PLatform based on Recruit (agency_id) where recruit_status=1
        $platform = DB::table('tb_recruit')
        ->Join('tb_platform', 'tb_recruit.platform_id', '=', 'tb_platform.id')
        ->where('tb_recruit.recruit_status', '=', 1)
        ->where('tb_recruit.agency_id', '=', $modal->agency_id)
        ->select('tb_recruit.platform_id', 'tb_platform.platform_name')
        ->get();

        // dd(json_decode(json_encode($platform), true));

        // dd($modal);
        $data = [
            'title' => 'Edit Host',
            'id' => $id,
            'host_uid' => $modal->host_uid,
            'host_name' => $modal->host_name,
            'platform_id' => $modal->platform_id,
            'agency_id' => $modal->agency_id,
            'agency' => $agency,
            'platform' => json_decode(json_encode($platform), true)
            // 'total_agency' => $modal->total_agency,
            // 'total_host' => $modal->total_host
        ];
        return view('admin.host.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $result = json_encode($request);

        $request->validate([
            'host_uid' => 'required',
            'host_name' => 'required',
            'platform_id' => 'required',
            'agency_id' => 'required',
        ]);

        Host::where('id', '=', $request->id)
        ->update([
            'host_uid' => $request->host_uid,
            'host_name' => $request->host_name,
            'platform_id' => $request->platform_id,
            'agency_id' => $request->agency_id,
            // 'total_agency' => $modal->total_agency,
            // 'total_host' => $modal->total_host
        ]);

        $host = Host::find($id);
        $host_agency_count = DB::table('tb_host')
        ->select('tb_host.id')
        ->where('agency_id', '=', $host->agency_id)
        ->count();

        // dd($recruit_platform_count);
        if($host_agency_count > 0)
        {
            Agency::where('id', $host->agency_id)
            ->update([
                'total_host' => $host_agency_count
            ]);
        }

        return redirect()->route('host.index')->with('success', 'Successfully Update Host');
    }
    public function create()
    {
        if (str_contains( auth()->user()->level_access, 'Admin'))
        {
            $agency = Agency::all();
            $platform = [];
        } else {
            $agency = Agency::where('id',auth()->user()->agency_id)->get();
            $platform = DB::table('tb_recruit')
            ->Join('tb_platform', 'tb_recruit.platform_id', '=', 'tb_platform.id')
            ->where('tb_recruit.recruit_status', '=', 1)
            ->where('tb_recruit.agency_id', '=', auth()->user()->agency_id)
            ->select('tb_recruit.platform_id', 'tb_platform.platform_name')
            ->get();
        }
        // $platform = Platform::where('platform_status', '=', '1')->get();
        $data = [
            'title' => 'Create Host',
            'agency' => $agency,
            'platform' => json_decode(json_encode($platform), true),
            'auth_agency_id' => auth()->user()->agency_id
        ];
        return view('admin.host.create', $data);
    }
    public function store(Request $request)
    {
        // $result = json_decode($request);
        // dd($request);

        $request->validate([
            'host_uid' => 'required',
            'host_name' => 'required',
            'platform_id' => 'required',
            'agency_id' => 'required',
        ]);

        $create_host = Host::create([
            'host_uid' => $request->host_uid,
            'host_name' => $request->host_name,
            'platform_id' => $request->platform_id,
            'agency_id' => $request->agency_id,
            
        ]);
        
        // agency update total host
        $host_agency_count = DB::table('tb_host')
        ->select('tb_host.id')
        ->where('agency_id', '=', $create_host->agency_id)
        ->count();

        // dd($recruit_platform_count);
        if($host_agency_count > 0)
        {
            Agency::where('id', $create_host->agency_id)
            ->update([
                'total_host' => $host_agency_count
            ]);
        }
        // platform update total host
        $platform_agency_count = DB::table('tb_host')
        ->select('tb_host.id')
        ->where('agency_id', '=', $create_host->platform_id)
        ->count();

        // dd($recruit_platform_count);
        if($platform_agency_count > 0)
        {
            Platform::where('id', $create_host->platform_id)
            ->update([
                'total_host' => $platform_agency_count
            ]);
        }

        return redirect()->route('host.index')->with('success', 'Successfully Create New Host');
    }
    public function destroy($id)
    {
        DB::delete('delete from tb_host where id = ?', [$id]);

        return redirect()->route('host.index')->with('success', 'Successfully Delete Host');
    }

    public function fetchAgencyOptions(Request $request)
    {
        // // Select Agency first -> Shows PLatform based on Recruit (agency_id) where recruit_status=1
        // Implement your logic to fetch the filtered content options based on the $filterValue
        $filteredOptions = DB::table('tb_recruit')
        ->Join('tb_platform', 'tb_recruit.platform_id', '=', 'tb_platform.id')
        ->where('tb_recruit.recruit_status', '=', 1)
        ->where('tb_recruit.agency_id', '=', $request->agency_id)
        ->select('tb_recruit.platform_id', 'tb_platform.platform_name')
        ->get();

        return response()->json($filteredOptions);
    }
}
