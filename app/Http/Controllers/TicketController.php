<?php

namespace App\Http\Controllers;

use App\Models\Categories;
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
        $query = Ticket::with('user', 'category')->where('user_id', $userId);

        // Terapkan filter
        if ($filter === 'officer_empty') {
            $query->whereNull('officer_id');
        }

        $tickets = $query->get();

        return view('tickets.index', compact('tickets'));
    }

    public function createTicket()
    {
        $categories = Categories::all(); // Ambil semua kategori
        return view('tickets.create', compact('categories')); // Kirim kategori ke view
    }

    public function storeTicket(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id', // Validasi untuk category
        ]);

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'category_id' => $request->category_id, // Simpan category_id
            'user_id' => Auth::id(),
        ]);

        // $tickets->user()->sync($request->siswa_id);

        return redirect()->route('user.ticket')->with('success', 'Product created successfully.');
    }

    public function editTicket(Ticket $ticket)
    {
        // Cek jika status adalah accepted, closed, atau canceled
        if (in_array($ticket->status, ['accepted', 'closed', 'canceled'])) {
            return redirect()
                ->route('user.ticket')
                ->with(['error' => 'You cannot edit a ticket that is already accepted, closed, or canceled.']);
        }

        $categories = Categories::all(); // Ambil semua kategori untuk ditampilkan di form edit
        return view('tickets.edit', compact('ticket', 'categories')); // Kirim kategori ke view
    }

    public function updateTicket(Request $request, Ticket $ticket)
    {
        // Cek jika status adalah accepted, closed, atau canceled
        if (in_array($ticket->status, ['accepted', 'closed', 'canceled'])) {
            return redirect()
                ->route('user.ticket')
                ->with(['error' => 'You cannot update a ticket that is already accepted, closed, or canceled.']);
        }

        // Validasi input dari request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id', // Validasi untuk category
        ]);

        // Update tiket
        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('user.ticket')->with('success', 'Ticket updated successfully.');
    }

    public function destroyTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('user.ticket')->with('success', 'Product deleted successfully.');
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

        // // Kirim notifikasi ke user
        // $user = $ticket->user; // Asumsi bahwa tiket memiliki relasi user
        // $user->notify(new TicketAccepted($ticket));

        return redirect()->route('ticket')->with('success', 'Ticket accepted successfully.');
    }

    public function showAcceptForm($id)
    {
        $ticket = Ticket::where('id', $id)->where('officer_id', null)->first();

        if (!$ticket) {
            return redirect()->route('ticket')->with('error', 'Ticket not found or already accepted.');
        }

        return view('tickets.officerAction.accept', compact('ticket'));
    }
}
