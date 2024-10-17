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

    public function adminHome($id = null) {
        // Fetch counts for users, pending tickets, and closed tickets
        $totalUsers = User::where('type', 'user')->count();
        $totalPending = Ticket::where('status', 'pending')->count();
        $totalClosed = Ticket::where('status', 'closed')->count();
    
        // Fetch tickets where 'officer_id' is null (to show in a list)
        // If $id is passed, attempt to find the specific ticket with that id
        $tickets = Ticket::whereNull('officer_id')->get();
        $selectedTicket = Ticket::where('id', $id)->whereNull('officer_id')->first(); // If a specific ID is needed
    
        return view('layouts.admin.home', compact('totalUsers', 'totalPending', 'totalClosed', 'tickets', 'selectedTicket'));
    }
    

    public function officerHome(){
        return view('layouts.officer.home');
    }

    public function userHome(){
        return view('layouts.user.home');
    }
}
