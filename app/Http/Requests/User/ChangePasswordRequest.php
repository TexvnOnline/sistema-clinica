<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $auth = $this->user();
        return $this->user()->can('update_password', $auth);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => [
                'required',
                function($attribute, $value, $fail){
                    if(!Hash::check($value, $this->user()->password)){
                        $fail($attribute . 'Tu contraseña no coincide');
                    }
                }
            ],
            'password' => 'required|string|min:8|confirmed',
            ];
        
    }

    // public function messages()
    // {
    //     'old_password.'
    // }
}
