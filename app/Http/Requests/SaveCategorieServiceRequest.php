<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCategorieServiceRequest extends FormRequest
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
            
            "name_categorie" => ['required', 'max:255', 'unique:categorie_grades,name_categorie'],
            "description" => ['required', ],
            "id_service" => ['required'],

        ];
    }
}
