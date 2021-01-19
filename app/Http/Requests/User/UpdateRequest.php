<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        $user = $this->route('user');
        return $this->user()->can('update', $user);
    }
    public function rules()
    {
        return [
            'name'=>'required|string|max:255',
            'dob'=>'required',
            'email'=>'required|string|email|unique:users,email,'. $this->route('user')->id.'|max:255',
        ];
    }
    public function messages(){
        return[

            'name.required'=>'Este campo es requerido',
            'name.string'=>'El valor no es correcto',
            'name.max'=>'Solo se permiten 255 caracteres',

            'dob.required'=>'Este campo es requerido',

            'email.required'=>'Este campo es requerido',
            'email.string'=>'El valor no es correcto',
            'email.email'=>'No es un correo electrónico',
            'email.max'=>'Solo se permiten 255 caracteres',
            'email.unique'=>'Este email ya está registrado',
        ];
    }
}
