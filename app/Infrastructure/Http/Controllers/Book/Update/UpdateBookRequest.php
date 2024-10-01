<?php

namespace App\Infrastructure\Http\Controllers\Book\Update;

use App\Infrastructure\Http\Models\BaseRequest;

class UpdateBookRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'max:40',
            'publisher' => 'max:40',
            'edition' => 'max:999',
            'publicationYear' => 'max:9999',
            'price' => 'min:0.01',
            'authors' => 'array',
            'authors.*' => 'string',
            'subjects' => 'array',
            'subjects.*' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'O título deve ter no máximo 40 caracteres',
            'publisher.max' => 'A editora deve ter no máximo 40 caracteres',
            'edition.max' => 'A edição deve ter no máximo 999 caracteres',
            'publicationYear.max' => 'O ano de publicação deve ter no máximo 9999 caracteres',
            'price.min' => 'O preço deve ser no mínimo 0.01',
            'authors.array' => 'Os autores devem ser um array',
            'authors.*.string' => 'Os autores devem ser strings',
            'subjects.array' => 'Os assuntos devem ser um array',
            'subjects.*.string' => 'Os assuntos devem ser strings',
        ];
    }
}