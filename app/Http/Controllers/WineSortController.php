<?php

namespace App\Http\Controllers;

use App\Enums\WineSort;
use App\Http\Requests\WineIndexRequest;
use App\Models\Wine;
use Illuminate\Http\JsonResponse;

class WineSortController extends Controller
{
    public function index(WineIndexRequest $request): JsonResponse
    {
        $style = $request->input('style');
        return response()->json(
            $style ? Wine::whereIn('style', $style)->select(['sort'])->distinct()->pluck('sort')->all() : WineSort::cases()
        );
    }
}
