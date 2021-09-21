<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'username_input' => ['nullable', 'string', 'max:255'],
            'email_input' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email'],
            'birthday_input' => ['nullable', 'regex:/(?:0[1-9]|[12][0-9]|3[01])\/(?:0[1-9]|1[0-2])\/(?:19|20\d{2})/'],
            'phone_input' => ['nullable', 'regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/'],
            'address_input' => ['nullable', 'string'],
            'aboutme_input' => ['nullable', 'string'],
            'avatar_input' => ['nullable', 'image']
        ];
    }
}
