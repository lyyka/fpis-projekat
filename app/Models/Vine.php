<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vine extends Model
{
    protected $fillable = ['name', 'style', 'sort', 'price', 'stock_qty'];

    public function priceReal(): Attribute
    {
        return new Attribute(
            get: fn() => $this->price * 100
        );
    }

    public function vineImages(): HasMany
    {
        return $this->hasMany(VineImage::class);
    }

    public function mainImage(): HasOne
    {
        // or use some `order` column, if it did exist
        return $this->hasOne(VineImage::class)->latestOfMany();
    }
}
