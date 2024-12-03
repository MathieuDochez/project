<?php

namespace App\Enums;

enum ProductCategory: string
{
    case TOYS = 'Toys';
    case FOOD = 'Food';
    case ACCESSORIES = 'Accessories';
    case BEDS = 'Beds';
    case GROOMING = 'Grooming';
    case CLOTHING = 'Clothing';
    case HOUSING = 'Housing';
}
