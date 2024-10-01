<?php

namespace App\Infrastructure\Http\Controllers\Subject\GetByDescription;

use App\Infrastructure\Http\Models\BaseRequest;

class GetSubjectsByDescriptionRequest extends BaseRequest
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
            'description.required' => 'Descrição é obrigatoria',
        ];
    }
}