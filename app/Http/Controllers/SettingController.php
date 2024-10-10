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
        'email' => 'required|email',
        'password' => 'nullable|min:8|confirmed',
    ]);

    // Update user
    $user = auth()->user();
    $user->email = $request->email;

    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    // Redirect back dengan pesan sukses
    return redirect()->route('setting')->with('success', 'Pengaturan berhasil diperbarui.');
}

}

