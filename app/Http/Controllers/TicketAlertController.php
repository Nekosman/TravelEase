<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketAlertController extends Controller
{
    public function index()
    {
        return view('Ticket.ticket_alert');
    }
}
