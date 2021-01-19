<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', User::class);
    }
    public function rules()
    {
        return [
            'role'=>'numeric|required',
            'name'=>'required|string|max:255',
            'dob'=>'required',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6|confirmed',
        ];
    }
    public function messages(){
        return[
            'role.required'=>'Este campo es requerido',
            'role.numeric'=>'El valor no es correcto',

            'name.required'=>'Este campo es requerido',
            'name.string'=>'El valor no es correcto',
            'name.max'=>'Solo se permiten 255 caracteres',

            'dob.required'=>'Este campo es requerido',

            'email.required'=>'Este campo es requerido',
            'email.string'=>'El valor no es correcto',
            'email.email'=>'No es un correo electrónico',
            'email.max'=>'Solo se permiten 255 caracteres',
            'email.unique'=>'Este email ya está registrado',

            'password.required'=>'Este campo es requerido',
            'password.string'=>'El valor no es correcto',
            'password.min'=>'Tu contraseña debe tener al menos 6 caracteres',
            'password.confirmed'=>'La contraseña no coincide',
        ];
    }
}
