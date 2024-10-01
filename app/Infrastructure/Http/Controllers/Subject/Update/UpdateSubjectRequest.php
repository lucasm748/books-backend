<?php

namespace App\Infrastructure\Http\Controllers\Subject\Update;

use App\Infrastructure\Http\Models\BaseRequest;

class UpdateSubjectRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Descrição é obrigatória',
        ];
    }
}