<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'image_1' => [Rule::when($this->conditionalImageUpdate(), '', ['required']), Rule::file()->image()->max(1024 * 3), 'mimes:jpg,jpeg,png'],
            'image_2' => [Rule::file()->image()->max(1024 * 3), 'mimes:jpg,jpeg,png'],
            'image_3' => [Rule::file()->image()->max(1024 * 3), 'mimes:jpg,jpeg,png'],
            'image_4' => [Rule::file()->image()->max(1024 * 3), 'mimes:jpg,jpeg,png'],
            'stock' => ['required', 'string', 'min:1'],
            'goods_price' => ['required', 'string'],
            'sell_price' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
        ];
    }

    private function conditionalImageUpdate(): bool
    {
        return $this->isMethod('patch') or $this->isMethod('put');
    }
}
