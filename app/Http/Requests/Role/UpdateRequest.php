<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = $this->route('role');
        return $this->user()->can('update', $role);
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:roles,name,'.$this->route('role')->id.'|max:255',
            'description'=>'required',
        ];
    }
    public function message(){
        return[
            'name.required'=>'El campo de nombre es requerido',
            'name.unique'=>'El nombre ya está ocupado',
            'description.required'=>'La descripción es requerida',
        ];
    }
}
