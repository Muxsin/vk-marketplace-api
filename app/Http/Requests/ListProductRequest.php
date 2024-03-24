<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ListProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sort_by' => ['in:created_at,price'],
            'sort_type' => ['in:asc,desc'],
            'filter_by' => ['in:price'],
            'filter_min' => ['numeric'],
            'filter_max' => ['numeric'],
            'filter_exact' => ['numeric'],
        ];
    }
}
