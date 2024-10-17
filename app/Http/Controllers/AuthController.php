<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function register(){
        return view('auth.register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'user',
            'is_approved' => true
        ]);

        return redirect()->route('login');
    }

    public function login(){
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        // Validasi input
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ])->validate();

        // Cek kredensial
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Regenerasi session
        $request->session()->regenerate();

        // Cek apakah user sudah disetujui
        if (!auth()->user()->is_approved) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Akun Anda belum disetujui oleh admin.']);
        }

        // Tambahkan flash message untuk notifikasi berhasil login
        session()->flash('success', 'Anda berhasil login.');

        // Redirect berdasarkan tipe user
        if (auth()->user()->type === 'user') {
            return redirect()->route('user.home');
        } else if (auth()->user()->type === 'admin') {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('officer.home');
        }
    }


    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    
}
