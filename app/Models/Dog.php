<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'additional_info',
        'image_path'
    ];

    protected $casts = [
        'age' => 'decimal:1',
        'weight' => 'decimal:1',
    ];

    // Get image URL for display
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }

        // Fallback to legacy naming system (for existing images)
        $legacyPath = 'img/' . $this->name . '.jpg';
        return asset('storage/' . $legacyPath);
    }

    // Check if dog has an image
    public function hasImage()
    {
        if ($this->image_path) {
            return true;
        }

        // Check legacy naming system
        $legacyPath = 'img/' . $this->name . '.jpg';
        return file_exists(public_path('storage/' . $legacyPath));
    }
}
