<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    /**
     * Show the form for resetting the password.
     *
     * @return \Illuminate\View\View
     */
    public function showResetForm()
    {
        return view('auth.forgot-password'); // Adjust the view path if necessary
    }

    /**
     * Handle the password reset request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        // Validate the request data
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the old password matches the current authenticated user's password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok.']);
        }

        // Update the user's password
        Auth::user()->update(['password' => Hash::make($request->new_password)]);

        // Redirect with a success message
        return redirect()->route('landing.page')->with('status', 'Password berhasil direset.');
    }
}


