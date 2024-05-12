<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

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
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'gender' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'phone_number' => ['required', new PhoneNumber],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ];
    }
}
