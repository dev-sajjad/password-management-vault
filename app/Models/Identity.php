<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'first_name', 'last_name', 'username', 'company', 'passport_number', 'license_number', 'email', 'phone', 'address', 'city', 'country', 'notes'];


    // Validation rules
    public static $rules = [
        'name' => 'required|string',
        'first_name' => 'nullable|string',
        'last_name' => 'nullable|string',
        'username' => 'nullable|string',
        'company' => 'nullable|string',
        'passport_number' => 'nullable|numeric',
        'license_number' => 'nullable|numeric',
        'email' => 'nullable|email',
        'phone' => 'nullable|numeric',
        'address' => 'nullable|string',
        'city' => 'nullable|string',
        'country' => 'nullable|string',
        'notes' => 'nullable|string',
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
