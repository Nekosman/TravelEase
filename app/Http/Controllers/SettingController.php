<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        // Fetch the currently authenticated user
        $user = Auth::user();

        return view('setting.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Validate the input fields for profile information
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Update user profile information
        $user = Auth::user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        // Redirect back with a success message
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

        $user = Auth::user();

        // Check if the current password matches
        if (!\Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update user password
        $user->password = \Hash::make($validated['new_password']);
        $user->save();

        // Redirect back with a success message
        return back()->with('success', 'Password updated successfully!');
    }
}
