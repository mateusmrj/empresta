<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSimuladorRequest extends FormRequest
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
            'valor_emprestimo' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'instituicoes' => ['sometimes','required','array',Rule::in(["BMG","PAN", "OLE"])],
            'convenios' => ['sometimes','required','array',Rule::in(["INSS","FEDERAL", "SIAPE"])],
            'parcela' => ['sometimes','required','integer',Rule::in([36,48,60,74,84])]
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'valor_emprestimo.required' => 'O valor do emprestivo é obrigatório',
            'valor_emprestimo.numeric' => 'O valor do emprestivo aceita apenas numeros',
            'valor_emprestimo.regex' => 'O valor do emprestivo deve ser no formato 99999.99',
            'instituicoes.rule'=> 'Só é aceito os valores',
            'parcela.integer' => "O valor da parcela têm que ser um numero inteiro",

        ];
    }
}
