<?php

namespace App\Infrastructure\Http\Controllers\Subject\Create;

use App\Infrastructure\Http\Models\BaseRequest;

class CreateSubjectRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description' => 'required|string|max:20',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Descrição é obrigatória',
            'description.string' => 'Descrição deve ser uma string',
            'description.max' => 'Descrição deve ter no máximo 20 caracteres',
        ];
    }
}