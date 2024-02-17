<?php

namespace App\Http\Controllers;

use App\Enums\WineSort;
use Illuminate\Http\JsonResponse;

class WineSortController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(WineSort::cases());
    }
}
