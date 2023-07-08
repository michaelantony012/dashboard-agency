<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('admin.dashboard',$data);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out');
    }
}
