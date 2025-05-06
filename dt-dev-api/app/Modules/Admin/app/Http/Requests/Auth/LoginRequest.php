<?php

namespace Modules\Admin\App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login_id' => 'required|string|min:5|max:10',
            'password' => 'required|string|min:5',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'login_id.required' => 'The login id field is required.',
            'password.required' => 'The password field is required.',
        ];
    }
}
