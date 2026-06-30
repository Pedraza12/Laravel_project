<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\HasNestedIncludes;

class Product extends Model
{
    use HasNestedIncludes;
{
    protected $fillable = [
        'sku', 'name', 'price', 'weight', 'descriptions',
        'thumbnail', 'image', 'category', 'create_date', 'stock',
    ];

    protected $casts = [
        'create_date' => 'date',
    ];

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories')
                    ->withTimestamps();
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'product_options')
                    ->withTimestamps();
    }
}
