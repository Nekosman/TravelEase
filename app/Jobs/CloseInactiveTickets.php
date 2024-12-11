<?php

namespace App\Jobs;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class CloseInactiveTickets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $threeHoursAgo = Carbon::now()->subMinutes(1);

        $tickets = Ticket::where('status', 'accepted')
            ->whereDoesntHave('messages', function ($query) use ($threeHoursAgo) {
                $query->where('created_at', '>=', $threeHoursAgo);
            })
            ->get();

            foreach($tickets as $ticket){
                $ticket->update(['status' => 'closed']);
            }
    }
}
