<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserlistController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all'); // Default filter is 'all'

        // Query builder awal
        $query = User::query();

        // Mapping untuk filter
        $filters = [
            'admin' => function ($query) {
                $query->where('type', 'admin');
            },
            'officer' => function ($query) {
                $query->where('type', 'officer');
            },
            'user' => function ($query) {
                $query->where('type', 'user');
            },
        ];

        // Terapkan filter jika ada di mapping
        if (isset($filters[$filter])) {
            $filters[$filter]($query);
        }

        // Mengambil data berdasarkan query
        $UserList = $query->get();

        return view('UserList.index', compact('UserList'));
    }

    public function createOfficer()
    {
        return view('UserList.create');
    }

    public function storeOfficer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'type' => 'officer',
            'is_approved' => false,
        ]);

        return redirect()->route('user.list')->with('success', 'Officer Create Successfully');
    }

    public function toggleApproval($id)
    {
        if (auth()->check() && auth()->user()->type === 'admin') {
            $user = User::findOrFail($id);
            $user->is_approved = !$user->is_approved;
            $user->save();

            return redirect()->back()->with('success', 'Approval status changed!');
        } else {
            return redirect()->back()->with('error', 'you cannot do this function if you are not admin');
        }
    }

    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Cek jika user bertipe 'admin'
        if ($user->type === 'admin') {
            return redirect()->route('user.list')->with('error', 'Admin users cannot be deleted.');
        }

        // Hapus user jika bukan 'admin'
        $user->delete();

        return redirect()->route('user.list')->with('success', 'User deleted successfully');
    }
}
