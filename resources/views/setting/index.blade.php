@extends('layouts.user.sidebar')
@section('title', 'Setting')
@section('contents')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Account Settings</h1>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                <i class="fas fa-user mr-2 text-blue-500"></i>Profile Information
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications" aria-selected="false">
                <i class="fas fa-bell mr-2 text-yellow-500"></i>Notification Preferences
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">
                <i class="fas fa-lock mr-2 text-red-500"></i>Security Settings
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content bg-white shadow-md rounded-lg p-8 mt-4" id="settingsTabContent">

        <!-- Profile Information Tab -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('setting.update.profile') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="font-semibold">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user['name']) }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="font-semibold">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user['email']) }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block">Save Profile Information</button>
            </form>
        </div>

        <!-- Notification Preferences Tab -->
        <!-- Notification Preferences Tab -->
        <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
            <form action="{{ route('setting.update.notifications') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email_notifications" class="font-semibold">Email Notifications</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="email_notifications" name="email_notifications" {{ old('email_notifications', $user['emailNotifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="email_notifications"></label>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="push_notifications" class="font-semibold">Push Notifications</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="push_notifications" name="push_notifications" {{ old('push_notifications', $user['pushNotifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="push_notifications"></label>
                    </div>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block">Save Notification Preferences</button>
            </form>
        </div>

        <!-- Security Settings Tab -->
        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
            <form action="{{ route('setting.update.security') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="current_password" class="font-semibold">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="new_password" class="font-semibold">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="font-semibold">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror">
                    @error('confirm_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block">Update Security Settings</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
