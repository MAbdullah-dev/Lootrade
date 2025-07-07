<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'video_path',
        'entry_cost',
        'max_entries_per_user',
        'prize',
        'slots',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'prizes'     => 'array'
    ];


    public function raffleTickets()
    {
        return $this->hasMany(RaffleTicket::class);
    }


    public function winners()
    {
        return $this->hasMany(Winner::class);
    }
    protected function status(): Attribute
    {
        return Attribute::get(function () {
            $now = now();
            if ($this->start_date <= $now && $this->end_date >= $now) {
                return 'active';
            } elseif ($this->start_date > $now) {
                return 'upcoming';
            } else {
                return 'past';
            }
        });
    }
}
