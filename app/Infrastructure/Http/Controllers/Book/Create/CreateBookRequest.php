<?php

namespace App\Infrastructure\Http\Controllers\Book\Create;

use App\Infrastructure\Http\Models\BaseRequest;


class CreateBookRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:40',
            'publisher' => 'required|string|max:40',
            'edition' => 'required|integer',
            'publicationYear' => 'required|integer',
            'price' => 'required|numeric',
            'authors' => 'required|array',
            'authors.*' => 'string',
            'subjects' => 'required|array',
            'subjects.*' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Título é obrigatório',
            'title.string' => 'Título deve ser uma string',
            'title.max' => 'Título deve ter no máximo 40 caracteres',
            'publisher.required' => 'Editora é obrigatória',
            'publisher.string' => 'Editora deve ser uma string',
            'publisher.max' => 'Editora deve ter no máximo 40 caracteres',
            'edition.required' => 'Edição é obrigatória',
            'edition.integer' => 'Edição deve ser um número inteiro',
            'publicationYear.required' => 'Ano de publicação é obrigatório',
            'publicationYear.integer' => 'Ano de publicação deve ser um número inteiro',
            'price.required' => 'Preço é obrigatório',
            'price.numeric' => 'Preço deve ser um número',
            'authors.required' => 'Autores são obrigatórios',
            'authors.array' => 'Autores devem ser um array',
            'authors.*.string' => 'Autores devem ser strings',
            'subjects.required' => 'Assuntos são obrigatórios',

        ];
    }
}