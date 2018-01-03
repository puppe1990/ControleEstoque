<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutosRequest extends FormRequest
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
           'codigo_produto' => 'required|max:10',
           'descricao' => 'required|max:100',
           'valor' => 'required|max:100',
           'valor' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'codigo_produto.required' => 'Código do Produto deve ser preenchido.',
            'descricao.required' => 'Descrição deve ser preenchida.',
            'valor.required' => 'Valor deve ser preenchida.',
            'valor.numeric' => 'O campo valor deve ser númerico.',
        ];
    }
}
