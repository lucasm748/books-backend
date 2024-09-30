<?php

namespace App\Infrastructure\Http\Controllers\Author\Create;

use App\Infrastructure\Http\Models\BaseRequest;
use Illuminate\Contracts\Validation\Validator;


class CreateAuthorRequest extends BaseRequest
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