<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
       'ticket_no' ,'title', 'description', 'priority', 'user_id', 'officer_id', 'scheduled_at', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    public static function boot()
{
    parent::boot();

    static::creating(function ($ticket) {
        // Cari nomor tiket terakhir untuk user yang sama
        $lastTicket = Ticket::where('user_id', $ticket->user_id)->max('ticket_no');

        // Jika belum ada tiket untuk user tersebut, mulai dari 1
        $ticket->ticket_no = $lastTicket ? $lastTicket + 1 : 1;
    });
}

    
    
}
