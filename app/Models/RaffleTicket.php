<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaffleTicket extends Model
{
    use HasFactory;

    protected $table = 'user_tickets';

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
}
