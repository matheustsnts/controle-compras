<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password' => 'required|min:8|confirmed|different:current_password',
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail(__('A senha atual está incorreta.'));
                }
            }]

        ];
    }

    public function messages() {
        return [
            'current_password.required' => 'O campo Senha atual é obrigatório.',
            'current_password.min' => 'O campo Senha atual deve conter no mínimo 8 caracteres',
            'password.required' => 'O campo Nova senha é obrigatório.',
            'password.min' => 'O campo Nova senha deve conter no mínimo 8 caracteres.',

        ];
    }

    
}
