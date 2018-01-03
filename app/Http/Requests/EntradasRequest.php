<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradasRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'quantidade.required' => 'Quantidade deve ser preenchida.',
            'quantidade.numeric' => 'O campo quantidade deve ser númerico.',
        ];
    }
}
