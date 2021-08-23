<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveNewItemRequest extends FormRequest
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
            
            'title' => ['required', 'unique:new_items,title', 'max:255'],
            'content' => ['required'],
            'date' => ['required', 'min:2020-01-01'],
            'state' => ['required', Rule::in(['Visible', 'Disabled']),],

        ];
    }
}
