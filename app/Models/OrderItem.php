<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = ['wine_id', 'order_id', 'qty'];

    public function wine(): BelongsTo
    {
        return $this->belongsTo(Wine::class);
    }
}
