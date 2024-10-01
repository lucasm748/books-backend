<?php

namespace App\Infrastructure\Http\Controllers\Author\GetByName;

use JsonSerializable;

class GetAuthorsByNameResponse implements JsonSerializable
{
    private array $authors;

    public function __construct(array $authors)
    {
        $this->authors = $authors;
    }

    public function jsonSerialize(): mixed
    {
        return  [
            'autores' => array_map(function ($author) {
                return [
                    'codigo' => $author->getId(),
                    'nome' => $author->getName()
                ];
            }, $this->authors)
        ];
    }
}