<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'members',
        'all_agree',
        'animals',
        'why_adopt',
        'allowed_to_have_pets',
        'terms',
        'user_id',
        'pet_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'members' => 'integer',
        'all_agree' => 'boolean',
        'animals' => 'boolean',
        'allowed_to_have_pets' => 'boolean',
        'terms' => 'boolean',
        // 'why_adopt' is text, so no casting needed for that field
    ];

    /**
     * Get the user that owns the form.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
