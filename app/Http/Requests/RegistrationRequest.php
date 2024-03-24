<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'login' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[A-Za-z0-9_]+$/', 'unique:users'],
            'password' => ['required', 'string', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/\d/', 'regex:/[@$!%*?&]/', 'min:8'],
        ];
    }
}
