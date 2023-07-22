<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agency;
use App\Models\Recruit;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PlatformController extends Controller
{
    public function index()
    {
        $modal = DB::table('tb_platform')
        ->select('tb_platform.*')->get();
        // dd($modasl);
        $data_modal = [];
        foreach(json_decode($modal, true) as $item)
        {
            $subarray=[];
            $subarray['id'] = $item['id'];
            $subarray['platform_name'] = $item['platform_name'];
            $subarray['platform_status'] = $item['platform_status'] == 1? "true" : "false";
            $subarray['total_agency'] = $item['total_agency'];
            $subarray['total_host'] = $item['total_host'];
            $data_modal[] = $subarray;
        }
        // dd($data_modal);
        $data = [
            'title' => 'Platform',
            'data_modal' => $data_modal
        ];
        
        return view('admin.platform.index', $data)->withData($data);
    }
    public function edit($id)
    {
        $modal = Platform::find($id);
        // dd('id: '.$id);
        $data = [
            'title' => 'Edit Platform',
            'id' => $id,
            'platform_name' => $modal->platform_name,
            'platform_status' => $modal->platform_status,
            // 'total_agency' => $modal->total_agency,
            // 'total_host' => $modal->total_host
        ];
        return view('admin.platform.edit', $data);
    }
    public function update(Request $request, $id)
    {
        // dd('name: '.$request->name.', email: '.$request->email.', password: '.Hash::make($request->password));
        $result = json_encode($request);
        // dd($result);

        $request->validate([
            'platform_name' => 'required',
            'platform_status' => 'required',
        ]);

        Platform::where('id', '=', $request->id)
        ->update([
            'platform_name' => $request->platform_name,
            'platform_status' => $request->platform_status
            // 'total_agency' => $modal->total_agency,
            // 'total_host' => $modal->total_host
        ]);

        return redirect()->route('platform.index')->with('success', 'Successfully Update Platform');
    }
    public function create()
    {
        $data = [
            'title' => 'Create Platform'
        ];
        return view('admin.platform.create', $data);
    }
    public function store(Request $request)
    {
        // $result = json_decode($request);
        // dd($request);

        $request->validate([
            // 'agency_code' => 'required',
            'platform_name' => 'required',
            'platform_status' => 'required',
        ]);

        $create_platform = Platform::create([
            'platform_name' => $request->platform_name,
            'platform_status' => $request->platform_status
            // 'total_agency' => $modal->total_agency,
            // 'total_host' => $modal->total_host
            
        ]);

        // Auto Recruit
        if($create_platform && $create_platform->platform_status==1)
        {
            $agency = Agency::get();
            foreach($agency as $agent)
            {
                Recruit::create([
                    'platform_id' => $create_platform->id,
                    'agency_id' => $agent->id,
                    'recruit_status' => 0 // false
                ]);
            }
        }
        // End Auto Recruit

        return redirect()->route('platform.index')->with('success', 'Successfully Create New Platform');
    }
    public function destroy($id)
    {
        DB::delete('delete from tb_platform where id = ?', [$id]);

        return redirect()->route('platform.index')->with('success', 'Successfully Delete Platform');
    }
}
