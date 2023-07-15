<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $remember_me = $request->remember? true : false;

        $validated = Auth::attempt(['email' => $request->email, 'password' => $request->password, 'level_access' => 'Admin'], $remember_me);

        if($validated)
        {
            return redirect()->route('dashboard')->with('success', 'Login Successfull');
        }else{
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
}
