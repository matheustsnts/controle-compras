<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoStoreRequest extends FormRequest
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
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.regex' => 'O campo nome não possui números em seu nome',
            'nome.min' => 'O campo possui poucos caracteres',
            'nome.max' => 'O campo excedeu a quantidade de caracteres'
        ];
    }
}
