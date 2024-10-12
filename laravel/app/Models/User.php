<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'username',
    ];
    public function teams()
    {
        return $this->hasMany(Team::class, 'team_leader_id');
    }

    // Relationship with Employee
    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    // Relationship with Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
