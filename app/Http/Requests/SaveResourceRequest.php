<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveResourceRequest extends FormRequest
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
            
            'name_resource' => ['required', 'unique:resources,name_resource'],
            'description' => ['required'],
            'image' => ['required', 'max:255'],
            'document' => ['required', 'max:255', 'exists:resources,document']

        ];
    }
}
