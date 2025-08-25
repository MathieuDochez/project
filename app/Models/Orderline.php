<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orderline extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'name', 'description', 'price', 'total_price', 'quantity'];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->quantity * $this->price;
    }

    public function getFormattedTotalPriceAttribute()
    {
        return '€' . number_format($this->getTotalPriceAttribute(), 2);
    }
}
