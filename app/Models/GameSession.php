<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'raffle_id',
        'mode',
        'status',
        'secured_entries',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function rounds()
    {
        return $this->hasMany(GameRound::class);
    }
}
