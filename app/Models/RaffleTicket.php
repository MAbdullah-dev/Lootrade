<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaffleTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'raffle_id',
        'user_ticket_id',
        'ticket_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function userTicket()
    {
        return $this->belongsTo(UserTicket::class);
    }
}
