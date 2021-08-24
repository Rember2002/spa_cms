<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveAcademicOfferRequest extends FormRequest
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
            
            'name_offer' => ['required', 'max:255','unique:academic_offers,name_offer'],
            'description' => ['required'],
            'image' => ['required', 'max:255'],
            'state' => ['required', Rule::in(['Visible', 'Disabled']),],

        ];
    }
}
