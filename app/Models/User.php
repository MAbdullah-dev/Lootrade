<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'profile_picture',
        'date_of_birth',
        'joined_date',
        'role_id',
        'ticket_balance',
        'profile_completion_awarded',
        'last_login_award_date',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at'         => 'datetime',
        'date_of_birth'             => 'date',
        'joined_date'               => 'date',
        'last_login_award_date'     => 'date',
        'profile_completion_awarded' => 'boolean',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function socialAccounts()
    {
        return $this->hasMany(UserSocialAccount::class);
    }


    // public function userTickets()
    // {
    //     return $this->hasMany(UserTicket::class);
    // }


    public function raffleTickets()
    {
        return $this->hasMany(Ticket::class);
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }


    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
