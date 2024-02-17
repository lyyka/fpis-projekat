<?php

namespace App\Http\Requests;

use App\Enums\WineSort;
use App\Enums\WineStyle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WineIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'style' => ['nullable', 'array'],
            'style.*' => ['required', 'string', Rule::enum(WineStyle::class)],

            'sort' => ['nullable', 'array'],
            'sort.*' => ['required', 'string', Rule::enum(WineSort::class)],
        ];
    }
}
