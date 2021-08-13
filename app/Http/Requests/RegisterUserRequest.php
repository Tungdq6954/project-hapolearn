<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'alpha_dash'],
            'email_register' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password_register' => ['required', 'string', 'min:8', 'same:password_register_confirmation'],
            'password_register_confirmation' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The username field is required',
            'name.alpha_dash' => 'The username must only contain letters, numbers, dashes and underscores.',
            'email_register.required' => 'The email field is required',
            'password_register.same' => 'The repeat password field is not the same as the password field',
        ];
    }
}
