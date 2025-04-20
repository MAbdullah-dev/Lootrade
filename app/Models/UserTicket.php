<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_number',
        'status',
        'acquisition_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function raffleTickets()
    {
        return $this->hasMany(RaffleTicket::class);
    }
}
