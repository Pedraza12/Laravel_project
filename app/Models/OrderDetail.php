<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasNestedIncludes;

class OrderDetail extends Model
{
    use HasNestedIncludes;
{
    protected $fillable = [
        'order_id', 'product_id', 'price', 'sku', 'quantity',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
