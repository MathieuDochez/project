<?php

namespace App\Models;

use App\Enums\ProductCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'category' => ProductCategory::class,
    ];

    // Relationships
    public function baskets(): HasMany
    {
        return $this->hasMany(Basket::class);
    }

    public function orderlines(): HasMany
    {
        return $this->hasMany(Orderline::class);
    }

    // Scopes
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeByCategory($query, ProductCategory $category)
    {
        return $query->where('category', $category);
    }

    // Accessors
    public function getIsInStockAttribute()
    {
        return $this->stock > 0;
    }

    public function getFormattedPriceAttribute()
    {
        return '€' . number_format($this->price, 2);
    }

    // Methods
    public function decreaseStock($quantity = 1)
    {
        if ($this->stock >= $quantity) {
            $this->decrement('stock', $quantity);
            return true;
        }
        return false;
    }

    public function increaseStock($quantity = 1)
    {
        $this->increment('stock', $quantity);
    }
}
