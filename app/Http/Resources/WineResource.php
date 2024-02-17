<?php

namespace App\Http\Resources;

use App\Models\Wine;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Wine */
class WineResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'style' => $this->style,
            'sort' => $this->sort,
            'price' => $this->price_real,
            'stock_qty' => $this->stock_qty,
            'images' => WineImageResource::collection($this->whenLoaded('wineImages')),
        ];
    }
}
