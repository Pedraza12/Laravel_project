<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasNestedIncludes;

class Customer extends Model
{
    use HasNestedIncludes;
{
    protected $fillable = [
        'email', 'password', 'full_name', 'billing_address',
        'default_shipping_address', 'country', 'phone',
    ];

    protected $hidden = ['password'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
