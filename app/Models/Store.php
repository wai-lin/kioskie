<?php

namespace App\Models;

use App\Enums\StoreRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory;

    /**
     * Users that belong to the store.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Store owners.
     */
    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->wherePivot('role', StoreRole::OWNER->value)
            ->withTimestamps();
    }

    /**
     * Store employees.
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role')
            ->wherePivot('role', StoreRole::EMPLOYEE->value)
            ->withTimestamps();
    }

    /**
     * Store transactions.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
