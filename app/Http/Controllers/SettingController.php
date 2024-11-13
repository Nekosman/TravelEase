<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $layout = 'layouts.user.sidebar'; // Default layout

        if (auth()->check()) {
            if (auth()->user()->type == 'admin') {
                $layout = 'layouts.admin.sidebar';
            } elseif (auth()->user()->type == 'officer') {
                $layout = 'layouts.officer.sidebar';
            }
        }

        // Get the authenticated user
        $user = Auth::user();

        return view('setting.index', compact('layout', 'user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,jpg,png|max:10000',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $user = Auth::user();

        // Mengunggah gambar profil jika ada
        if ($request->hasFile('profile_image')) {
            // Hapus gambar profil lama jika ada
            if ($user->profile_image) {
                Storage::delete(str_replace('/storage/', 'public/', $user->profile_image));
            }

            // Simpan gambar baru
            $imagePath = $request->file('profile_image')->store('public/assets/img');
            $user->profile_image = Storage::url($imagePath);
        }

        // Update hanya nama dan email
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updateNotifications(Request $request)
    {
        // Validate the input fields for notification preferences
        $validated = $request->validate([
            'email_notifications' => 'boolean',
            'push_notifications' => 'boolean',
        ]);

        // Update user notification preferences
        $user = Auth::user();
        $user->email_notifications = $request->has('email_notifications');
        $user->push_notifications = $request->has('push_notifications');
        $user->save();

        // Redirect back with a success message
        return back()->with('success', 'Notification preferences updated successfully!');
    }

    public function updateSecurity(Request $request)
    {
        // Validate the input fields for security settings
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        // Check if the current password is correct
        if (!\Hash::check($validated['current_password'], Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update user password
        $user = Auth::user();
        $user->password = bcrypt($validated['new_password']);
        $user->save();

        // Redirect back with a success message
        return back()->with('success', 'Password updated successfully!');
    }
}
