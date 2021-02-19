<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'email' => [
                'sometimes',
                'email',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'profile_picture' => 'sometimes|image'
        ];
    }
}
