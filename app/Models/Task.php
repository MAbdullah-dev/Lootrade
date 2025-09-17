<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    protected $fillable = [
        'username',
        'platform',
        'action',
        'link',
        'meta',
        'reward',
        'is_active',
    ];

    protected $casts = [
        'meta' => 'array',
        'is_active' => 'boolean',
    ];

    public function usersCompleted(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('completed_at');
    }
}
