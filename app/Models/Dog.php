<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'breed',
        'age',
        'weight',
        'color',
        'owner',
    ];

    protected $casts = [
        'age' => 'float',
        'weight' => 'float',
    ];

    // Scope for filtering by breed
    public function scopeByBreed($query, $breed)
    {
        return $query->where('breed', $breed);
    }

    // Accessor for formatted age
    public function getFormattedAgeAttribute()
    {
        return $this->age . ' year' . ($this->age != 1 ? 's' : '');
    }

    // Accessor for formatted weight
    public function getFormattedWeightAttribute()
    {
        return $this->weight . ' kg';
    }
}
