<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'username', 'password', 'url', 'notes'];

    // validation rules
    public static $rules = [
        'name' => 'required|string',
        'username' => 'nullable|string',
        'password' => 'nullable|string',
        'url' => 'nullable|string',
        'notes' => 'nullable|string',
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
