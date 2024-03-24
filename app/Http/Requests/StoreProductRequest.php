<?php

namespace App\Http\Requests;

use App\Rules\ProductImageRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:products'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['required', 'string', 'url', new ProductImageRule()],
            'price' => ['required', 'numeric', 'min:0.01'],
        ];
    }
}
