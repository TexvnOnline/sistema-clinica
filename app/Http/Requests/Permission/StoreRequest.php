<?php

namespace App\Http\Requests\Permission;

use App\Permission;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', Permission::class);
    }
    public function rules()
    {
        return [
            'name'=>'required|max:255',
            'description'=>'required',
            'role_id'=>'required|numeric',
        ];
    }
    public function messages(){
        return[
            'name.required'=>'El campo de nombre es requerido',
            'description.required'=>'La descripción es requerida',
            'role_id.required'=>'El rol es requerido',
            'role_id.numeric'=>'El identificador del rol tiene que ser un numero',
        ];
    }
}
