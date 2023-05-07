<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'initials',
        'lastname'
    ];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn() => trim("{$this->initials} {$this->lastname}")
        );
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
