<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
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
}
