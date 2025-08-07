<?php

namespace App\Enums;

enum ProductCategory: string
{
    case TOYS = 'toys';
    case FOOD = 'food';
    case ACCESSORIES = 'accessories';
    case BEDS = 'beds';
    case GROOMING = 'grooming';
    case CLOTHING = 'clothing';
    case HOUSING = 'housing';

    public function label(): string
    {
        return match($this) {
            self::TOYS => 'Toys',
            self::FOOD => 'Food',
            self::ACCESSORIES => 'Accessories',
            self::BEDS => 'Beds',
            self::GROOMING => 'Grooming',
            self::CLOTHING => 'Clothing',
            self::HOUSING => 'Housing',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function($case) {
            return [$case->value => $case->label()];
        })->toArray();
    }
}
