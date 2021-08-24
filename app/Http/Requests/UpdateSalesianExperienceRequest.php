<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSalesianExperienceRequest extends FormRequest
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
            'name_event' => ['required', 'max:255'],
            'description' => ['required'],
            'date' => ['required', 'min:2020-01-01'],
            'place' => ['required', 'max:255'],
            'image' => ['required', 'max:255'],
            'type' => ['required', Rule::in(['Coro', 'Orquesta', 'Selecciones deportivas', 'Coreografia', 'Oratorio']),],
        ];
    }
}
