<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'nome' => 'required|regex:/^[a-zA-Z]+$/|min:3|max:32',
            
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
