<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'holder_name', 'brand', 'number', 'exp_month', 'exp_year', 'notes'];

    //Validation rules
    public static $rules = [
        'name' => 'required|string|max:255',
        'holder_name' => 'nullable|string|max:255',
        'brand' => 'nullable|string',
        'number' => 'nullable|numeric|max:20',
        'exp_month' => 'nullable|string',
        'exp_year' => 'nullable|numeric',
        'notes' => 'nullable|string',
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
