<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password',
        ];

    }

    public function messages(): array
    {
        return [

            'password.required'           => 'The password is required.',
            'password.string'             => 'The password must be a valid string.',
            'password.min'                => 'The password must be at least 8 characters long.',
            'password.confirmed'          => 'The password confirmation does not match.',

            'confirm_password.required'   => 'The confirm password field is required.',
            'confirm_password.string'     => 'The confirm password must be a valid string.',
            'confirm_password.same'       => 'The confirm password must match the password.',
        ];
    }

}
