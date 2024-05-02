<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class CustomerRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::when($this->conditionalEmailUpdate(), Rule::unique(User::class)->ignore($this->customer->id ?? null)), ''],
            'phone_number' => ['nullable', new PhoneNumber],
            'password' => [Rule::when($this->conditionalPasswordUpdate(), '', ['required', Rules\Password::defaults(), 'max:255'])],
        ];
    }

    private function conditionalPasswordUpdate(): bool
    {
        return $this->isMethod('patch') or $this->isMethod('put');
    }

    private function conditionalEmailUpdate(): bool
    {
        return $this->isMethod('patch') or $this->isMethod('put');
    }
}
