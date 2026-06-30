<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\HasNestedIncludes;

class Option extends Model
{
    use HasNestedIncludes;
{
    protected $fillable = ['option_name'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_options')
                    ->withTimestamps();
    }
}
