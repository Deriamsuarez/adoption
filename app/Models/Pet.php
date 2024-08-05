<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    use HasFactory;
    use Sluggable;


    protected $fillable = [
        'name',
        'slug',
        'description',
        'breed_id',
        'type',
        'photo',
        'gender',
        'weight',
        'energy_level',
        'age',
        'current_size',
        'adult_size',
        'training_level',
        'coat',
        'province_id',
        'temperament',
        'vaccinated',
        'dewormed',
        'neutered',
        'special_needs',
        'special_needs_notes',
        'medical_history',
        'published_by',
        'active',

    ];

    protected $casts = [
        'weight' => 'float',
        'vaccinated' => 'boolean',
        'dewormed' => 'boolean',
        'neutered' => 'boolean',
        'special_needs' => 'boolean',
        'temperament' => 'string',
    ];

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'file_pet');
    }

    public function publisher() // Nueva relación para el campo 'published_by'
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function forms() // Relación con los formularios
    {
        return $this->hasMany(Form::class, 'pet_id');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }



    
}
