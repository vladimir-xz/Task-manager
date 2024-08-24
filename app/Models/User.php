<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function createdTasks()
    {
        return $this->hasMany('App\Models\Task', 'created_by_id');
    }

    public function assignedTasks()
    {
        return $this->hasMany('App\Models\Task', 'assigned_to_id');
    }

    public function outgoingMessages()
    {
        return $this->hasMany('App\Models\Message', 'created_by_id');
    }

    public function incomingMessages()
    {
        return $this->hasMany('App\Models\Message', 'recipient_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'recipient_id');
    }
}
