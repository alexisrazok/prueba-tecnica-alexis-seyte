<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SuperHeroSearchFormRequest extends FormRequest
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
            'search' => ['required', 'string', 'regex:/^[a-zA-Z0-9 \-]+$/']
        ];
    }

    /**
     * Removes the extra left and right spices for validation
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'search' => Str::trim($this->search),
        ]);
    }
}
