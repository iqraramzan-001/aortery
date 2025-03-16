<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'type'=>'required',
            'company_name'       => 'required|string|max:255',
            'register_number' => 'required|string|max:255',
            'email'              => 'required|email|unique:users,email|max:255',
            'confirm_email'      => 'required|email|same:email',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|same:password',
        ];

    }

    public function messages(): array
    {
        return [
            'type.required'               => "Please select Supplier or Buyer.",
            'company_name.required'       => 'The company name is required.',
            'company_name.max'            => 'The company name must not exceed 255 characters.',

            'register_number.required'    => 'The registration  number is required.',
            'register_number.max'         => 'The registration number must not exceed 255 characters.',

            'email.required'              => 'The email address is required.',
            'email.email'                 => 'Enter a valid email address.',
            'email.unique'                => 'This email is already registered.',
            'email.max'                   => 'The email must not exceed 255 characters.',

            'confirm_email.required'      => 'The confirm email field is required.',
            'confirm_email.email'         => 'Enter a valid email address.',
            'confirm_email.same'          => 'Confirm email must match the email.',

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
