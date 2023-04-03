<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\ {
    AuthService
};

class LoginRequest extends FormRequest
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
        $field = AuthService::checkFieldType($this->identity);

        $fieldValidation = ['required', "exists:users,email"];
        if ($field == 'email') {
          $fieldValidation = ['required'];
        }

        return [    
            'email' => $fieldValidation,
            'password' => ['required', 'min:8'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email required!',
            'email.exists' => 'Email already exists!',
            'password.required' => 'Password is required',
            'password.min' => 'Password must at least be 5 characters',
        ];
    }
}
