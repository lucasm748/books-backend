<?php

namespace App\Infrastructure\Http\Controllers\Author\Create;

use App\Infrastructure\Http\Models\BaseRequest;


class CreateAuthorRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:40',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.string' => 'Nome deve ser uma string',
            'name.max' => 'Nome deve ter no máximo 40 caracteres',
        ];
    }
}