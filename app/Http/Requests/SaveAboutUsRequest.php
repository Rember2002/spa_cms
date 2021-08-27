<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveAboutUsRequest extends FormRequest
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
            
            'name' => ['required', 'unique:about_us,name' ,'max:255'],
            'description' => ['required'],
            'type' => ['required', Rule::in(['Mission', 'View', 'Value']),],
            'year' => ['required', 'numeric', 'min:2020'],
            'image' => ['required'],

        ];
    }
}
