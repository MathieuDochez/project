<?php

namespace App\Helpers;

use App\Models\Item;
use Storage;

class Cart
{
    private static array $cart = [
        'items' => [],
        'totalQty' => 0,
        'totalPrice' => 0
    ];


    public static function init(): void
    {
        self::$cart = session()->get('cart') ?? self::$cart;
    }

    // add record to the cart
    public static function add(Item $item): void
    {
        $singlePrice = $item->price;
        if (array_key_exists($item->id, self::$cart['records'])) {
            self::$cart['records'][$item->id]['qty']++;
            self::$cart['records'][$item->id]['price'] += $singlePrice;
        } else {
            self::$cart['records'][$item->id] = [
                'id' => $item->id,
                'artist' => $item->artist,
                'title' => $item->title,
                'mb_id' => $item->mb_id,
                'cover' => Storage::disk('public')->exists('covers/' . $item->mb_id . '.jpg')
                    ? '/storage/covers/' . $item->mb_id . '.jpg'
                    : '/storage/covers/no-cover.png',
                'price' => $singlePrice,
                'qty' => 1
            ];
        }
        self::updateTotal();
    }

    // delete record from the cart
    public static function delete(Item $item): void
    {
        $singlePrice = $item->price;
        if (array_key_exists($item->id, self::$cart['records'])) {
            self::$cart['records'][$item->id]['qty']--;
            self::$cart['records'][$item->id]['price'] -= $singlePrice;
            if (self::$cart['records'][$item->id]['qty'] == 0) {
                unset(self::$cart['records'][$item->id]);
            }
        }
        self::updateTotal();
    }

    // empty the cart
    public static function empty(): void
    {
        session()->forget('cart');
    }

    // re-calculate the total quantity and price of records in the cart
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
        session()->put('cart', self::$cart);   // store the cart in the session
    }

    // get the complete cart
    public static function getCart(): array
    {
        return self::$cart;
    }

    // get all the records from the cart
    public static function getRecords(): array
    {
        return self::$cart['records'];
    }

    // get one record from the cart
    public static function getOneRecord($key = 0): array
    {
        if (array_key_exists($key, self::$cart['records'])) {
            return self::$cart['records'][$key];
        }
        return [];
    }

    // get all the record keys
    public static function getKeys(): array
    {
        return array_keys(self::$cart['records']);
    }

    // get total quantity of records in the cart
    public static function getTotalQty(): int
    {
        return self::$cart['totalQty'];
    }

    // get total price of records in the cart
    public static function getTotalPrice(): float
    {
        return self::$cart['totalPrice'];
    }
}

Cart::init();
