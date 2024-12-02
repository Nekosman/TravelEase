<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,jpg,png|max:10000',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Mengunggah dan memperbarui gambar profil jika ada
        if ($request->hasFile('profile_image')) {
            // Hapus gambar profil lama jika ada
            if ($user->profile_image) {
                Storage::delete(str_replace('/storage/', 'public/', $user->profile_image));
            }

            // Simpan gambar baru
            $imagePath = $request->file('profile_image')->store('public/assets/img');
            $user->profile_image = Storage::url($imagePath);
        }

        try {
            // Update profil pengguna dengan data yang tervalidasi
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'profile_image' => $user->profile_image,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => [
                    'user' => [
                        'name' => $user->name,
                        'profile_image' => $user->profile_image,
                        'email' => $user->email,
                    ],
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to update profile',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $validated = $request->validate([
                'current_password' => 'required|string',
                'new_password' => ['required', 'confirmed', Password::min(8)],
            ]);

            $user = Auth::user();

            // Check if current password matches
            if (!Hash::check($validated['current_password'], $user->password)) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Current password is incorrect',
                        'errors' => [
                            'current_password' => ['The provided password does not match our records.'],
                        ],
                    ],
                    422,
                );
            }

            // Update password
            $user->password = Hash::make($validated['new_password']);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully',
                'data' => null,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors(),
                ],
                422,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to update password',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function updateNotifications(Request $request)
    {
        $validated = $request->validate([
            'email_notifications' => 'boolean',
            'push_notifications' => 'boolean',
        ]);

        $user = Auth::user();

        try {
            $user->update([
                'email_notifications' => $request->email_notifications ?? false,
                'push_notifications' => $request->push_notifications ?? false,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Notification preferences updated successfully',
                'data' => [
                    'email_notifications' => $user->email_notifications,
                    'push_notifications' => $user->push_notifications,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to update notification preferences',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}