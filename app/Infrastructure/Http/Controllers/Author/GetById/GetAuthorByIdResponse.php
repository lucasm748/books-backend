<?php

namespace App\Infrastructure\Http\Controllers\Author\GetById;

use App\Domain\Entities\Author;
use JsonSerializable;


class GetAuthorByIdResponse implements JsonSerializable
{
    public Author $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'autor' => [
                'codigo' => $this->author->getId(),
                'nome' => $this->author->getName(),
            ]
        ];
    }
}