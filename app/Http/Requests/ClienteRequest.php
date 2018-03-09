<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
           'nome' => 'required|max:100',
           'celular' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Código do Produto deve ser preenchido.',
            'celular.required' => 'Descrição deve ser preenchida.',
        ];
    }
}
