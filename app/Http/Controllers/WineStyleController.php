<?php

namespace App\Http\Controllers;

use App\Enums\WineStyle;
use App\Http\Requests\WineIndexRequest;
use App\Models\Wine;
use Illuminate\Http\JsonResponse;

class WineStyleController extends Controller
{
    public function __invoke(WineIndexRequest $request): JsonResponse
    {
        $sort = $request->input('sort');
        return response()->json(
            $sort ? Wine::whereIn('sort', $sort)->select(['style'])->distinct()->pluck('style')->all() : WineStyle::cases()
        );
    }
}
