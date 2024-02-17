<?php

namespace App\Http\Controllers;

use App\Enums\WineStyle;
use Illuminate\Http\JsonResponse;

class WineStyleController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(WineStyle::cases());
    }
}
