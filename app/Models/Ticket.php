<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
       'ticket_no', 'title', 'description', 'priority', 'user_id', 'officer_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }    
}
