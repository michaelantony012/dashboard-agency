<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agency;
use App\Models\Recruit;
use App\Models\Platform;
use App\Models\PlatformCode;
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
            $subarray['platform_code'] = $item['platform_code'];
            $subarray['platform_name'] = $item['platform_name'];
            $subarray['platform_status'] = $item['platform_status'] == 1? "Active" : "Inactive";
            $subarray['platform_status_toggle'] = $item['platform_status'] == 1? "checked" : "";
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
            // 'platform_status' => $modal->platform_status,
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
            // 'platform_status' => 'required',
        ]);

        Platform::where('id', '=', $request->id)
        ->update([
            'platform_name' => $request->platform_name,
            // 'platform_status' => $request->platform_status
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
        
        // get platform code that's not occupied
        $get_code = PlatformCode::where('occupied', '=', 0)->orderBy('platform_code', 'asc')->first();

        $create_platform = Platform::create([
            'platform_code' => $get_code->platform_code,
            'platform_name' => $request->platform_name,
            'platform_status' => $request->platform_status
            // 'total_agency' => $modal->total_agency,
            // 'total_host' => $modal->total_host
            
        ]);

        // Auto Recruit
        if($create_platform /*&& $create_platform->platform_status==1*/ ) // revisi->auto create tidak melihat status platform aktif/tidak
        {
            // Set platform code to occupied
            PlatformCode::where('platform_code', $get_code->platform_code)->update(['occupied'=>1]);

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
        // update agency code to not occupied
        $platform = Platform::where('id', $id)->first();
        PlatformCode::where('platform_code', $platform->platform_code)->update(['occupied'=>0]);

        // Auto Delete Recruit
        DB::delete('delete from tb_recruit where platform_id = ?', [$id]);

        // Auto Delete Report Agency
        DB::delete('delete from tb_report where platform_id = ?', [$id]);

        // Auto Delete Host
        DB::delete('delete from tb_host where platform_id = ?', [$id]);

        DB::delete('delete from tb_platform where id = ?', [$id]);

        return redirect()->route('platform.index')->with('success', 'Successfully Delete Platform');
    }
    public function update_status(Request $request)
    {
        // dd($request->desc);
        if($request->desc == 'changeStatus')
        {
            $recruit = Platform::find($request->id);

            // Auto Inactive Recruit if Platform Status is set to Inactive
            if($request->status == 0)
            {
                $recruit_get = Recruit::where('platform_id', '=', $request->id)->get();
                foreach($recruit_get as $rec)
                {
                    Recruit::where('id', '=', $rec->id)->update([
                        'recruit_status' => 0
                    ]);
        
                    // agency update total host
                    $recruit = Recruit::find($rec->id);
                    $recruit_platform_count = DB::table('tb_recruit')
                    ->select('tb_recruit.platform_id')
                    ->where('agency_id', '=', $recruit->agency_id)
                    ->where('recruit_status', '=', 1)
                    ->count();
        
                        Agency::where('id', $recruit->agency_id)
                        ->update([
                            'total_platform' => $recruit_platform_count
                        ]);
        
                    // platform update total agency
                    $recruit_agency_count = DB::table('tb_recruit')
                    ->select('tb_recruit.agency_id')
                    ->where('platform_id', '=', $recruit->platform_id)
                    ->where('recruit_status', '=', 1)
                    ->count();
        
                        Platform::where('id', $recruit->platform_id)
                        ->update([
                            'total_agency' => $recruit_agency_count
                        ]);
                }
            }
            // Platform update status to active => jika recruit utk platform tsb belum ada , buat recruit
            else if ($request->status == 1)
            {
                $agency = Agency::all();
                foreach($agency as $agn)
                {
                    $recruited = Recruit::where('platform_id', $request->id)->where('agency_id', $agn->id)->first();
                    
                    if(!$recruited)
                    {
                        Recruit::create([
                            'platform_id' => $request->id,
                            'agency_id' => $agn->id,
                            'recruit_status' => 0 // false
                        ]);
                    }
                }
            }

            // Update
            Platform::where('id', '=', $request->id)->update([
                'platform_status' => $request->status
            ]);


        }
    }
}
