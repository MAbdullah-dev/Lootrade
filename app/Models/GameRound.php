<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameRound extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_session_id',
        'round_number',
        'picked_side',
        'is_correct',
    ];

    public function gameSession()
    {
        return $this->belongsTo(GameSession::class);
    }
}
