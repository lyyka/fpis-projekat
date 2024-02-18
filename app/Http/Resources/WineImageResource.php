<?php

namespace App\Http\Resources;

use App\Models\WineImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin WineImage */
class WineImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'image' => config('app.url') . "/storage/wine_images/$this->image",
        ];
    }
}
