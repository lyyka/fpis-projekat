<?php

namespace App\Http\Controllers;

use App\Http\Requests\WineIndexRequest;
use App\Http\Resources\WineResource;
use App\Models\Wine;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;

class WinesController extends Controller
{
    public function index(WineIndexRequest $request): JsonResource
    {
        return WineResource::collection(
            Wine::query()
                ->with(['wineImages'])
                ->when($request->input('style'), fn(Builder $builder, array $style) => $builder->whereIn('style', $style))
                ->when($request->input('sort'), fn(Builder $builder, array $sort) => $builder->whereIn('sort', $sort))
                ->get()
        );
    }
}
