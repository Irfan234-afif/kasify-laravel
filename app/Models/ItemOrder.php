<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemOrder extends Pivot
{
    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'detail',
    ];
}