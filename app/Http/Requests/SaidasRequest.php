<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaidasRequest extends FormRequest
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
           'quantidade' => 'required|max:10',
           'quantidade' => 'required|numeric',
           'created_at' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'quantidade.required' => 'Quantidade deve ser preenchida.',
            'quantidade.numeric' => 'O campo quantidade deve ser númerico.',
            'created_at.date' => 'Data Saída deve estar em formato data dd/mm/yyyy'
        ];
    }
}
