<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id',
        'ticket_package_id',
        'package_quantity',
        'total_tickets',
        'total_price',
        'stripe_transaction_id',
        'payment_status',
    ];

    public function ticketPackage()
    {
        return $this->belongsTo(TicketPackage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
