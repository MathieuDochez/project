<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderline(): HasOne
    {
        return $this->hasOne(Orderline::class);
    }
    public function getTotalPriceAttribute()
    {
        return $this->orderline()->where('order_id', $this->id)->sum('price');
    }

}
