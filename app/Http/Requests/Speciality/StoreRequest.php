<?php

namespace App\Http\Requests\Speciality;

use App\Speciality;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Speciality::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:specialities|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.unique' => 'El nombre está en uso.',
            'name.max' => 'Máximo 250 caracteres.'
        ];
    }
}
