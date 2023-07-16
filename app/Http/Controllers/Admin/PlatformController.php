<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Platform;

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
    public function update(Request $request)
    {
        // dd('name: '.$request->name.', email: '.$request->email.', password: '.Hash::make($request->password));
        $result = json_encode($request);
        // dd($result);

        $request->validate([
            'platform_name' => 'required',
            'platform_status' => 'required',
        ]);
        
        Platform::where('id', $request->id)
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

        Platform::create([
            'platform_name' => $request->platform_name,
            'platform_status' => $request->platform_status
            // 'total_agency' => $modal->total_agency,
            // 'total_host' => $modal->total_host
            
        ]);

        return redirect()->route('platform.index')->with('success', 'Successfully Create New Platform');
    }
    public function destroy($id)
    {
        // DB::delete('delete from platform where id = ?', [$id]);

        return redirect()->route('platform.index')->with('success', 'Successfully Delete Platform');
    }
}
