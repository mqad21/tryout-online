<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use App\Models\LoginActivity;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    // Halaman login.
    public function login()
    {
        return view('pages.login');
    }

    // Logic halaman login.
    public function login_post(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            LoginActivity::create(['user_id' => Auth::user()->id]);

            // save session_id
            $user = User::find(Auth::user()->id);
            $user->session_id = session()->getId();
            $user->save();

            return redirect('');
        } elseif ($user = User::firstWhere('email', $request->email)) {
            if ($user->google_id) return redirect()->back()->withErrors(['error' => 'Harap login menggunakan akun google']);
        }
        return redirect()->back()->withErrors(['error' => 'Username/password salah']);
    }

    // Logout.
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // Halaman daftar.
    public function daftar()
    {
        $regions = Region::all();
        return view('pages.daftar', compact('regions'));
    }

    // Logic daftar.
    public function daftar_post(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255|min:3',
                'email' => 'required|email|max:64',
                'password' => 'required',
                'region_id' => 'required',
            ]);

            if (User::firstWhere('email', $request->email)) {
                return redirect()->back()->withErrors(['error' => 'Email sudah digunakan.']);
            }

            if ($request->password != $request->confirm_password) {
                return redirect()->back()->withErrors(['error' => 'Konfirmasi password tidak cocok.']);
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'region_id' => $request->region_id,
                'role_id' => Role::SISWA
            ]);

            Auth::attempt(['email' => $request->email, 'password' => $request->password]);

            return redirect("/");
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Halaman lupa password.
    public function lupa_password(Request $request)
    {
        $token = $request->token;
        return view('pages.lupa-password', compact('token'));
    }

    // Logic lupa password.
    public function lupa_password_post(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        $user = User::firstWhere('email', $request->email);
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'Email tidak ditemukan.']);
        }

        $request->session()->flash('forgot_password', $request->email);
        $token = Str::random(64);
        $user->token_verification = $token;
        $user->save();
        Mail::to($request->email)->send(new ForgetPasswordMail($token));

        return redirect()->back();
    }

    // Logic reset password.
    public function reset_password(Request $request)
    {
        $user = User::firstWhere('token_verification', $request->token);
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'Token tidak valid.']);
        }

        if ($request->password != $request->confirm_password) {
            return redirect()->back()->withErrors(['error' => 'Konfirmasi password tidak cocok.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/login');
    }

    public function redirect()
    {
        return view('pages.redirect');
    }

}
