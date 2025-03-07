<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the stores that sell the product.
     */
    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Get the transactions that include the product.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
