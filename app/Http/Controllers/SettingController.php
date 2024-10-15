<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Method untuk menampilkan halaman setting
    public function index()
    {
        return view('setting.index'); // Mengarahkan ke view setting
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email', // Email harus diisi dan formatnya valid
            'password' => 'nullable|min:8|confirmed', // Password opsional tetapi jika diisi harus minimal 8 karakter dan cocok dengan konfirmasi password
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.min' => 'Password harus minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Update user
        $user = auth()->user();
        $user->email = $request->email;

        // Hanya update password jika diisi
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // Redirect back dengan pesan sukses
        return redirect()->route('setting')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
