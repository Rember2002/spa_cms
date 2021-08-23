<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveContactUsRequest extends FormRequest
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
            
            'phone' => ['required', 'unique:contact_us,phone'],
            'direction' => ['required', 'max:255'],
            'year' => ['required', 'unique:contact_us,year']
            
        ];
    }
}
