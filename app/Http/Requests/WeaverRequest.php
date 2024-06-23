<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WeaverRequest extends FormRequest
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
            'provinceSelect' => ['required', 'string', 'max:255'],
            'citySelect' => ['required', 'string', 'max:255'],
            'subdistrictSelect' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255', Rule::when($this->conditionalNameUpdate(), Rule::unique(User::class)->ignore($this->weaver->id ?? null), 'unique:users,name')],
            'gender' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'phone_number' => ['required', new PhoneNumber],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'subdistrict' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ];
    }

    private function conditionalNameUpdate(): bool
    {
        return $this->isMethod('patch') or $this->isMethod('put');
    }
}
