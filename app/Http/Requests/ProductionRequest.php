<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'estimate' => ['required', 'numeric'],
            'items.*.name' => ['required', 'string', 'max:255'],
            'items.*.category_name' => ['required', 'string'],
            'items.*.price' => ['required', 'string'],
            'products.*.name' => ['required', 'string', 'max:255'],
            'products.*.profit' => ['required', 'string'],
            'products.*.weaver_name' => ['required', 'string'],
            'products.*.category_name' => ['required', 'string'],
        ];
    }
}
