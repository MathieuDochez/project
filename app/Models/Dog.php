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
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            return asset('storage/' . $this->image_path);
        }

        // Fallback to legacy naming system (for existing images)
        $legacyPath = 'img/' . $this->name . '.jpg';
        if (Storage::disk('public')->exists($legacyPath)) {
            return asset('storage/' . $legacyPath);
        }

        // Final fallback placeholder
        return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0zMiAxNkMzNiAxNiA0MCAyMCA0MCAyNEM0MCAyOCAzNiAzMiAzMiAzMkMzMyAzMCAyNCAyOCAyNCAyNEMyNCAyMCAyOCAxNiAzMiAxNloiIGZpbGw9IiM5Q0EzQUYiLz4KICA8cGF0aCBkPSJNMTYgNDBDMTYgMzYgMjAgMzIgMjQgMzJINDBDNDQgMzIgNDggMzYgNDggNDBWNDhIMTZWNDBaIiBmaWxsPSIjOUNBM0FGIi8+Cjwvc3ZnPgo=';
    }

    // Check if dog has an image
    public function hasImage()
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            return true;
        }

        // Check legacy naming system
        $legacyPath = 'img/' . $this->name . '.jpg';
        return Storage::disk('public')->exists($legacyPath);
    }
}
