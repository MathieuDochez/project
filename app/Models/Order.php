<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'shipping_address',
        'city',
        'zip',
        'country',
        'notes',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderlines(): HasMany
    {
        return $this->hasMany(Orderline::class);
    }

    // Accessors
    public function getTotalPriceAttribute()
    {
        return $this->orderlines->sum(function($orderline) {
            return $orderline->quantity * $orderline->price;
        });
    }

    public function getFormattedTotalPriceAttribute()
    {
        return '€' . number_format($this->getTotalPriceAttribute(), 2);
    }

    //debugging and safety checks
    public static function createFromBasket($user, $shippingData)
    {
        // DEBUG: Check what's in the baskets
        \Log::info('Creating order for user: ' . $user->id);
        \Log::info('User baskets count: ' . $user->baskets->count());

        foreach ($user->baskets as $index => $basket) {
            \Log::info("Basket {$index}: user_id={$basket->user_id}, item_id={$basket->item_id}, quantity={$basket->quantity}");
        }

        $order = self::create([
            'user_id' => $user->id,
            'shipping_address' => $shippingData['address'] ?? null,
            'city' => $shippingData['city'] ?? null,
            'zip' => $shippingData['zip'] ?? null,
            'country' => $shippingData['country'] ?? null,
            'notes' => $shippingData['notes'] ?? null,
            'status' => 'pending',
        ]);

        foreach ($user->baskets as $basket) {
            // SAFETY CHECK - Make sure item_id exists
            if (!$basket->item_id) {
                \Log::error('Basket missing item_id: ' . json_encode($basket->toArray()));
                continue; // Skip this basket item
            }

            // SAFETY CHECK - Make sure item exists
            if (!$basket->item) {
                \Log::error('Basket item not found for item_id: ' . $basket->item_id);
                continue; // Skip this basket item
            }

            try {
                $orderline = $order->orderlines()->create([
                    'item_id' => $basket->item_id,
                    'quantity' => $basket->quantity,
                    'price' => $basket->item->price,
                ]);

                \Log::info('Created orderline: ' . json_encode($orderline->toArray()));

                // Decrease item stock
                $basket->item->decreaseStock($basket->quantity);

            } catch (\Exception $e) {
                \Log::error('Error creating orderline: ' . $e->getMessage());
                \Log::error('Basket data: ' . json_encode($basket->toArray()));
                throw $e; // Re-throw the error
            }
        }

        // Clear user's basket
        $user->baskets()->delete();

        return $order;
    }
}
