<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Relationship with Login model
    public function logins()
    {
        return $this->hasMany(Login::class);
    }


    // Relationship with Card model
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
    

    // Relationship with Identity model
    public function identities()
    {
        return $this->hasMany(Identity::class);
    }
}
