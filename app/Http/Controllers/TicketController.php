<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Notifications\TicketAccepted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function indexTicket(Request $request)
    {
        $userId = auth()->user()->id;

        $filter = $request->query('filter', 'all'); // Default filter is 'all'

        // Query builder awal
        $query = Ticket::with('user')->where('user_id', $userId);

        // Terapkan filter
        if ($filter === 'officer_empty') {
            $query->whereNull('officer_id');
        }

        $tickets = $query->get();

        return view('tickets.index', compact('tickets'));
    }

    public function createTicket()
    {
        return view('tickets.create');
    }

    public function storeTicket(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'user_id' => Auth::id(),
        ]);

        // $tickets->user()->sync($request->siswa_id);

        return redirect()->route('ticket.index')->with('success', 'Product created successfully.');
    }

    public function editTicket(Ticket $ticket)
    {
        if ($ticket->status === 'canceled' && 'closed') {
            return redirect()
                ->route('ticket.index')
                ->with(['error' => 'You cannot edit a scheduled ticket.']);
        } else {
            return view('tickets.edit', compact('ticket'));
        }
    }

    public function updateTicket(Request $request, Ticket $ticket)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully.');
    }

    public function destroyTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('ticket.index')->with('success', 'Product deleted successfully.');
    }

    //Fungsi action guru
    public function myTicketsForOfficer(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = Ticket::with('officer');

        if ($filter === 'officer_empty') {
            $query->where('officer_id', null)->where('status', 'pending');
        }

        $tickets = $query->get();

        return view('tickets.officerAction.index', compact('tickets'));
    }

    public function acceptTicket(Request $request, $id)
    {
        $ticket = Ticket::where('id', $id)->where('officer_id', null)->first();

        if (!$ticket) {
            return redirect()->route('officer.ticket')->with('error', 'Ticket not found or already accepted.');
        }

        // Update ticket untuk menetapkan guru_id dan mengubah status tanpa kolom scheduled_at
        $ticket->update([
            'officer_id' => Auth::id(),
            'status' => 'accepted', // Status diubah menjadi 'accepted' atau sesuai dengan logika Anda
        ]);

        // Kirim notifikasi ke user
        $user = $ticket->user; // Asumsi bahwa tiket memiliki relasi user
        $user->notify(new TicketAccepted($ticket));

        return redirect()->route('officer.ticket')->with('success', 'Ticket accepted successfully.');
    }

    public function showAcceptForm($id)
    {
        $ticket = Ticket::where('id', $id)->where('officer_id', null)->first();

        if (!$ticket) {
            return redirect()->route('officer.ticket')->with('error', 'Ticket not found or already accepted.');
        }

        return view('tickets.officerAction.accept', compact('ticket'));
    }
}
