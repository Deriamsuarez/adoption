<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'name', 'size'];

    public function pets()
    {
        return $this->belongsToMany(Pet::class, 'file_pet');
    }
}
