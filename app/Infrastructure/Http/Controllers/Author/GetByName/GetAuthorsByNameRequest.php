<?php

namespace App\Infrastructure\Http\Controllers\Author\GetByName;

use App\Infrastructure\Http\Models\BaseRequest;

class GetAuthorsByNameRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
        ];
    }
}
