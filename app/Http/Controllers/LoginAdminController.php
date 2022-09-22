<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
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
            return redirect()->route('dashboard.index');
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

    // Forgot Password Admin
        public function showLinkRequestForm()
        {
            return view('login.admin.password.email');
        }

        public function sendResetLink(Request $request)
        {
            $request->validate([
                'email' => 'required|email:dns|max:50'
            ], [
                'email.required' => 'Email harus di isi',
                'email.email' => 'Email harus menggunakan @gmail.com',
                'email.max' => 'Email tidak boleh lebih dari 50 karakter',
            ]);
            
            $checkEmail = DB::table('admins')->where(['email' => $request->email])->first();
            if (!($checkEmail)) {
                return back()->with('fail', 'Email anda belum terdaftar di Javie Taekwondo School');
            } else {
                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);

                $linkAction = route('adminReset.index', ['token' => $token, 'email' => $request->email]);
                $bodyEmail = "Anda menerima email ini karena kami menerima permintaan penyetelan ulang sandi untuk akun Anda. Silahkan klik reset password jika anda ingin mereset ulang password anda";

                Mail::send('template.adminReset', array(
                    'linkAction' => $linkAction,
                    'bodyEmail' => $bodyEmail,
                ), function ($message) use ($request) {
                    $message->from('cafedise@gmail.com', 'Cafedise');
                    $message->to($request->email)->subject('Reset Password');
                });
                
                return back()->with('info', 'Kami sudah mengirimkan link reset password ke email anda');
            }
        }
    // Forgot Password Admin

    // Reset Password Admin
        public function showResetForm(Request $request, $token = null)
        {
            return view('login.admin.password.reset')
            ->with(['token' => $token, 'email' => $request->email]);
        }

        public function resetPassword(Request $request)
        {
            $request->validate([
                'email' => 'required|email:dns|max:50',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
            ], [
                'password.required' => 'Password harus di isi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok dengan password',
            ]);

            $checkToken = DB::table('password_resets')->where([
                'email' => $request->email,
                'token' => $request->token,
            ])->first();

            if (!($checkToken)) {
                return back()->withInput()->with('fail', 'Silahkan gunakan link reset password yang terbaru');
            } else {
                Admin::where('email', $request->email)->update([
                    'password' => Hash::make($request->password),
                ]);

                DB::table('password_resets')->where([
                    'email' => $request->email,
                ])->delete();

                return redirect()->route('adminlogin.index')->with('info', 'Password anda sudah berhasil di reset, anda bisa login menggunakan password baru');
            }
        }
    // Reset Password Admin
}
