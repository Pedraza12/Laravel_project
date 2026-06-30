<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasNestedIncludes
{
    public function scopeInclude(Builder $query, array $relations = []): Builder
    {
        if (empty($relations)) {
            return $query;
        }

        return $query->with($relations);
    }
}
