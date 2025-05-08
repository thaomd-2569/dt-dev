<?php

namespace App\Modules\Admin\Http\Requests\Category;

use App\Enums\Category\CategoryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Update this logic based on your authorization requirements
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => ['required', Rule::in(CategoryStatus::getValues())], // Adjust the status values as per your application
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
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either enabled or disabled.',
        ];
    }
}
