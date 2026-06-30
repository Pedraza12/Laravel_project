<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\HasNestedIncludes;

class Category extends Model
{
    use HasNestedIncludes;
{
    protected $fillable = ['name', 'description', 'thumbnail'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_categories')
                    ->withTimestamps();
    }
}
