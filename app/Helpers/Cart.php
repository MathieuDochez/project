<?php

namespace App\Helpers;

use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class Cart
{
    private static array $cart = [
        'items' => [],
        'totalQty' => 0,
        'totalPrice' => 0
    ];

    // Initialize the cart from the session
    public static function init(): void
    {
        self::$cart = session()->get('cart') ?? self::$cart;
    }

    public static function add(Item $item): bool
    {
        // Refresh item from database to get current stock
        $item = $item->fresh();

        // Check if item is in stock
        if ($item->stock <= 0) {
            return false;
        }

        $singlePrice = $item->price;
        $currentQtyInCart = self::getOneItem($item->id)['qty'] ?? 0;
        $newTotalQty = $currentQtyInCart + 1;

        // Check if adding one more would exceed available stock
        if ($newTotalQty > $item->stock) {
            return false;
        }

        if (array_key_exists($item->id, self::$cart['items'])) {
            self::$cart['items'][$item->id]['qty']++;
            self::$cart['items'][$item->id]['price'] += $singlePrice;
        } else {
            self::$cart['items'][$item->id] = [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'price' => $singlePrice,
                'qty' => 1,
            ];
        }

        self::updateTotal();
        return true;
    }


    // Delete an item from the cart (decrease quantity or remove)
    public static function delete(Item $item): void
    {
        $singlePrice = $item->price;

        if (array_key_exists($item->id, self::$cart['items'])) {
            self::$cart['items'][$item->id]['qty']--;
            self::$cart['items'][$item->id]['price'] -= $singlePrice;

            // Remove the item if quantity reaches zero
            if (self::$cart['items'][$item->id]['qty'] == 0) {
                unset(self::$cart['items'][$item->id]);
            }
        }

        // Update the total quantity and price
        self::updateTotal();
    }

    // Empty the cart
    public static function empty(): void
    {
        session()->forget('cart');
    }

    // Recalculate the total quantity and price of items in the cart
    private static function updateTotal(): void
    {
        $totalQty = 0;
        $totalPrice = 0;

        foreach (self::$cart['items'] as $item) {
            $totalQty += $item['qty'];
            $totalPrice += $item['price'];
        }

        self::$cart['totalQty'] = $totalQty;
        self::$cart['totalPrice'] = $totalPrice;

        // Store the updated cart in the session
        session()->put('cart', self::$cart);
    }

    // Get the complete cart
    public static function getCart(): array
    {
        return self::$cart;
    }

    // Get all items in the cart
    public static function getItems(): array
    {
        return self::$cart['items'];
    }

    // Get a single item by its ID
    public static function getOneItem($key = 0): array
    {
        if (array_key_exists($key, self::$cart['items'])) {
            return self::$cart['items'][$key];
        }
        return [];
    }

    // Get all the item keys (IDs)
    public static function getKeys(): array
    {
        return array_keys(self::$cart['items']);
    }

    // Get the total quantity of items in the cart
    public static function getTotalQty(): int
    {
        return self::$cart['totalQty'];
    }

    // Get the total price of items in the cart
    public static function getTotalPrice(): float
    {
        return self::$cart['totalPrice'];
    }
}

Cart::init();
