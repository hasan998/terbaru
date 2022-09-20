<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginAdminController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logut');
    }

    public function index()
    {
        return view('login.admin.masuk');
    }

    public function login(Request $request)
    {
        // Validasi Login
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        // Kondisi ketika login
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            // Kondisi ketika login success
            return redirect()->intended(route('dashboard.index'));
        } else {
            // Kondisi ketika login failed
            return back()->with('status', 'Email dan Password Belum Terdaftar');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('adminlogin.index');
    }   
}
