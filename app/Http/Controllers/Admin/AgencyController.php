<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agency;
use App\Models\Recruit;
use App\Models\Platform;
use App\Models\AgencyCode;
use App\Models\PlatformCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AgencyController extends Controller
{
    public function index()
    {
        $modal = DB::table('tb_agency')
        ->select('tb_agency.*')->get();
        // dd($modasl);
        $data_modal = [];
        foreach(json_decode($modal, true) as $item)
        {
            $subarray=[];
            $subarray['id'] = $item['id'];
            $subarray['agency_code'] = $item['agency_code'];
            $subarray['agency_name'] = $item['agency_name'];
            $subarray['pic_idcard'] = $item['pic_idcard'];
            $subarray['pic_fullname'] = $item['pic_fullname'];
            $subarray['total_host'] = $item['total_host'];
            $subarray['total_platform'] = $item['total_platform'];
            $data_modal[] = $subarray;
        }
        // dd($data_modal);
        $data = [
            'title' => 'Agency',
            'data_modal' => $data_modal
        ];
        
        return view('admin.agency.index', $data)->withData($data);
    }
    public function edit($id)
    {
        $modal = Agency::find($id);
        // dd('id: '.$id);
        $data = [
            'title' => 'Edit Agency',
            'id' => $id,
            'agency_code' => $modal->agency_code,
            'agency_name' => $modal->agency_name,
            'agency_bank' => $modal->agency_bank,
            'agency_bank_id' => $modal->agency_bank_id,
            'pic_idcard' => $modal->pic_idcard,
            'pic_fullname' => $modal->pic_fullname,
            'pic_phone' => $modal->pic_phone,
            'total_platform' => $modal->total_platform,
            'total_host' => $modal->total_host
            // total_paidhost
            // total_salary
            // total_share
        ];
        return view('admin.agency.edit', $data);
    }
    public function update(Request $request, $id)
    {
        // dd('name: '.$request->name.', email: '.$request->email.', password: '.Hash::make($request->password));
        $result = json_encode($request);
        // dd($result);

        $request->validate([
            // 'agency_code' => 'required',
            'agency_name' => 'required',
            'agency_bank' => 'required',
            'agency_bank_id' => 'required',
            'pic_idcard' => 'required',
            'pic_fullname' => 'required',
            'pic_phone' => 'required'
        ]);

        Agency::where('id', $id)
        ->update([
            'agency_name' => $request->agency_name,
            'agency_bank' => $request->agency_bank,
            'agency_bank_id' => $request->agency_bank_id,
            'pic_idcard' => $request->pic_idcard,
            'pic_fullname' => $request->pic_fullname,
            'pic_phone' => $request->pic_phone
            // total_paidhost
            // total_salary
            // total_share
        ]);

        return redirect()->route('agency.index')->with('success', 'Successfully Update Agency');
    }
    public function create()
    {
        $data = [
            'title' => 'Create Agency'
        ];
        return view('admin.agency.create', $data);
    }
    public function store(Request $request)
    {
        // $result = json_decode($request);
        // dd($request);

        $request->validate([
            // 'agency_code' => 'required',
            'agency_name' => 'required',
            'agency_bank' => 'required',
            'agency_bank_id' => 'required',
            'pic_idcard' => 'required',
            'pic_fullname' => 'required',
            'pic_phone' => 'required'
        ]);

        // get agency code that's not occupied
        $get_code = AgencyCode::where('occupied', '=', 0)->orderBy('agency_code', 'asc')->first();

        // dd($get_code);

        $create_agency = Agency::create([
            'agency_code' => $get_code->agency_code,
            'agency_name' => $request->agency_name,
            'agency_bank' => $request->agency_bank,
            'agency_bank_id' => $request->agency_bank_id,
            'pic_idcard' => $request->pic_idcard,
            'pic_fullname' => $request->pic_fullname,
            'pic_phone' => $request->pic_phone
            // total_paidhost
            // total_salary
            // total_share
            
        ]);

        // Auto Recruit
        if($create_agency)
        {
            // Set agency code to occupied
            AgencyCode::where('agency_code', $get_code->agency_code)->update(['occupied'=>1]);

            $platform = Platform::where('platform_status','=','1')->get();
            foreach($platform as $plat)
            {
                Recruit::create([
                    'platform_id' => $plat->id,
                    'agency_id' => $create_agency->id,
                    'recruit_status' => 0 // false
                ]);
            }
        }
        // End Auto Recruit

        return redirect()->route('agency.index')->with('success', 'Successfully Create New Agency');
    }
    public function destroy($id)
    {
        // update agency code to not occupied
        $agency = Agency::where('id', $id)->first();
        AgencyCode::where('agency_code', $agency->agency_code)->update(['occupied'=>0]);

        // Auto Delete Recruit
        DB::delete('delete from tb_recruit where agency_id = ?', [$id]);

        // Auto Delete Report Agency
        DB::delete('delete from tb_report where agency_id = ?', [$id]);

        // Auto Delete Host
        DB::delete('delete from tb_host where agency_id = ?', [$id]);
        
        DB::delete('delete from tb_agency where id = ?', [$id]);

        return redirect()->route('agency.index')->with('success', 'Successfully Delete Agency');
    }
    public function loop()
    {
        // $i = 1200;
        // while($i<4801)
        // {
        //     AgencyCode::create(['agency_code'=>$i, 'occupied'=>false]);
        //     $i++;
        // }
        // $i = 10;
        // while($i<61)
        // {
        //     PlatformCode::create(['platform_code'=>$i, 'occupied'=>false]);
        //     $i++;
        // }
    }
}
