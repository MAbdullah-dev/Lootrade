<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements AuthMustVerifyEmail
{
    use HasFactory, Notifiable,SoftDeletes;

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
        'email_verified_at',
        'ticket_balance',
        'profile_completion_awarded',
        'last_login_at',
        'last_login_award_date',
    ];

    protected $dates = [
        'date_of_birth',
        'joined_date',
        'email_verified_at',
        'last_login_at',
        'last_login_award_date',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'date_of_birth' => 'date:Y-m-d',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function socialAccounts()
    {
        return $this->hasMany(UserSocialAccount::class);
    }

    public function tickets()
    {
        return $this->hasMany(UserTicket::class);
    }

    public function raffleTickets()
    {
        return $this->hasMany(RaffleTicket::class);
    }

    public function winners()
    {
        return $this->hasMany(Winner::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }
}

