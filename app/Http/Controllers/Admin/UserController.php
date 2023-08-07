<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        /*
        $data = [
            'title' => 'Users'
        ];
        $data1 = User::all();
        return view('admin.users.index')->withData($data1);
        */
        $modal = DB::table('users')
        ->leftJoin('tb_agency', 'users.agency_id', '=', 'tb_agency.id')
        ->where('users.show', 1)
        ->select('users.*', 'tb_agency.agency_name')
        ->get();
        // dd($modasl);
        $data_modal = [];
        foreach(json_decode($modal, true) as $item)
        {
            $subarray=[];
            $subarray['id'] = $item['id'];
            $subarray['name'] = $item['name'];
            $subarray['email'] = $item['email'];
            $subarray['level_access'] = $item['level_access'];
            $subarray['agency_name'] = $item['agency_name'];
            $data_modal[] = $subarray;
        }
        // dd($data_modal);
        $data = [
            'title' => 'Users',
            'data_modal' => $data_modal
        ];
        
        return view('admin.users.index', $data)->withData($data);
    }
    public function edit($id)
    {
        $agency = Agency::all();
        $modal = User::find($id);
        // dd('id: '.$id);
        $data = [
            'id' => $id,
            'title' => 'Edit User',
            'name' => $modal->name,
            'email' => $modal->email,
            'level_access' => $modal->level_access,
            'agency_id' => $modal->agency_id,
            'agency' => $agency,
        ];
        return view('admin.users.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            // 'password'=>'required',
            'level_access' => 'required'
        ]);
        // dd('name: '.$request->name.', email: '.$request->email.', password: '.Hash::make($request->password));
        // dd($request->level_access);
        $level_access="";
        $x = 0;
        foreach($request->level_access as $acc)
        {
            // dd($acc);
            if($x>0) { $level_access.=","; }
            $level_access.=$acc;
            $x++;
        }
        // dd($level_access);
        if(trim($request->password)=="")
        {
            User::where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'level_access' => $level_access,
                'agency_id' => $request->agency_id
            ]);
        } else
        {
            User::where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'level_access' => $level_access,
                'password' => Hash::make($request->password),
                'agency_id' => $request->agency_id
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Successfully Update User');
    }
    public function create()
    {
        $agency = Agency::all();
        $data = [
            'title' => 'Create User',
            'agency' => $agency,
        ];
        return view('admin.users.create', $data);
    }
    public function store(Request $request)
    {
        // dd($request->level_access);
        $level_access="";
        $x = 0;
        foreach($request->level_access as $acc)
        {
            // dd($acc);
            if($x>0) { $level_access.=","; }
            $level_access.=$acc;
            $x++;
        }
        // dd($level_access);

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'level_access' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level_access' => $level_access,
            'agency_id' => $request->agency_id
        ]);

        return redirect()->route('users.index')->with('success', 'Successfully Create New User');
    }
    public function destroy($id)
    {
        DB::delete("delete from users where id = ?", [$id]);
        // dd($id);

        return redirect()->route('users.index')->with('success', 'Successfully Delete User');
    }
}
