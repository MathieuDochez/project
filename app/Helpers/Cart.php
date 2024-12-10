<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Session;
use App\Models\Shop;

class Cart
{
    private static array $cart = [
        'items' => [], //was shops omdat het relate naar de shop model
        'totalQty' => 0,
        'totalPrice' => 0
    ];

    public static function init(): void
    {
        self::$cart = Session::get('cart') ?? self::$cart;
    }

    public static function add(Shop $shop)
    {
        $shopId = $shop->id;

        if (isset(self::$cart['items'][$shopId])) {
            self::$cart['items'][$shopId]['quantity'] += 1;
        } else {
            self::$cart['items'][$shopId] = [
                'id' => $shop->id,
                'name' => $shop->name,
                'price' => $shop->price,
                'quantity' => 1
            ];
        }

        self::$cart['totalQty'] += 1;
        self::$cart['totalPrice'] += $shop->price;

        Session::put('cart', self::$cart);
    }

    public static function delete(Shop $shop)
    {
        $shopId = $shop->id;

        if (isset(self::$cart['items'][$shopId])) {
            self::$cart['totalQty'] -= self::$cart['shops'][$shopId]['quantity'];
            self::$cart['totalPrice'] -= self::$cart['shops'][$shopId]['price'] * self::$cart['shops'][$shopId]['quantity'];

            unset(self::$cart['items'][$shopId]);

            Session::put('cart', self::$cart);
        }
    }

    public static function empty()
    {
        self::$cart = [
            'items' => [],
            'totalQty' => 0,
            'totalPrice' => 0
        ];

        Session::forget('cart');
    }

    public static function items()
    {
        return self::$cart['items'];
    }

    public static function total()
    {
        return self::$cart['totalPrice'];
    }

    public static function isEmpty()
    {
        return empty(self::$cart['items']);
    }
}
