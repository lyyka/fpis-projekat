<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wine extends Model
{
    protected $fillable = ['name', 'style', 'sort', 'price', 'stock_qty'];

    public function priceReal(): Attribute
    {
        return new Attribute(
            get: fn() => $this->price * 100
        );
    }

    public function wineImages(): HasMany
    {
        return $this->hasMany(WineImage::class);
    }
}
