<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveStudentCouncilRequest extends FormRequest
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
            
            'year' => ['required', 'numeric', 'min:2020', 'max:2099', 'unique:student_councils,year'],
            'image' => ['required', 'max:255'],

        ];
    }
}
