<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminHome(){
        $totalUsers = User::where('type', 'user')->count();
        $totalPending = Ticket::where('status', 'pending')->count();
        $totalClosed = Ticket::where('status', 'closed')->count();

        return view('layouts.admin.home', compact('totalUsers', 'totalPending', 'totalClosed'));
    }

    public function officerHome(){
        return view('layouts.officer.home');
    }

    public function userHome(){
        return view('layouts.user.home');
    }
}
