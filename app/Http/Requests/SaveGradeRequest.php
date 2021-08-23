<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveGradeRequest extends FormRequest
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
            
            'name_grade' => ['required', 'unique:grades,name_grade', 'max:255'],
            'description' => ['required'],
            'image' => ['required', 'max:255'],
            'id_academic_offer' => ['required', 'exists:academic_offers,id']

        ];
    }
}
