<?php

namespace App\Infrastructure\Http\Controllers\Author\Update;

use App\Infrastructure\Http\Models\BaseRequest;

class UpdateAuthorRequest extends BaseRequest
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