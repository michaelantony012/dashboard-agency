<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Users'
        ];
        $data1 = User::all();
        return view('admin.users.index')->withData($data1);
    }
    public function edit($id)
    {
        $modal = User::find($id);
        // dd('id: '.$id);
        $data = [
            'id' => $id,
            'title' => 'Edit User',
            'name' => $modal->name,
            'email' => $modal->email
        ];
        return view('admin.users.edit', $data);
    }
    public function update(Request $request)
    {
        // dd('name: '.$request->name.', email: '.$request->email.', password: '.Hash::make($request->password));
        
        User::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Successfully Update User');
    }
    public function create()
    {
        $data = [
            'title' => 'Create User'
        ];
        return view('admin.users.create', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 1,
            'level_access' => 'Admin'
        ]);

        return redirect()->route('users.index')->with('success', 'Successfully Create New User');
    }
    public function destroy($id)
    {
        // DB::delete('delete from users where id = ?', [$id]);

        return redirect()->route('users.index')->with('success', 'Successfully Delete User');
    }
}
