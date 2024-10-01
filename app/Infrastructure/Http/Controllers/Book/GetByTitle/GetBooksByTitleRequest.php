<?php

namespace App\Infrastructure\Http\Controllers\Book\GetByTitle;

use App\Infrastructure\Http\Models\BaseRequest;

class GetBooksByTitleRequest extends BaseRequest
{
    public function bookize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Título é obrigatorio',
        ];
    }
}