<?php

namespace App\Http\Requests;

use App\Models\ProgramUser;
use Illuminate\Foundation\Http\FormRequest;

class ApplyToProgramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ProgramUser::whereUserId($this->user()->id)
            ->whereProgramId($this->program->id)
            ->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
