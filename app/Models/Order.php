<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasNestedIncludes;

class Order extends Model
{
    use HasNestedIncludes;
{
    protected $fillable = [
        'customer_id', 'ammount', 'shipping_address', 'order_address',
        'order_email', 'order_date', 'order_status',
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
