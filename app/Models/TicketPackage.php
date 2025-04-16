<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketPackage extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'tickets', 'price'];
}
