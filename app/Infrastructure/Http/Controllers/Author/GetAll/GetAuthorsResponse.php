<?php

namespace App\Infrastructure\Http\Controllers\Author\GetAll;

use App\Domain\Entities\Author;
use JsonSerializable;


class GetAuthorsResponse implements JsonSerializable
{
    public array $authors;

    public function __construct(array $authors)
    {
        $this->authors = $authors;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'autores' => array_map(function (Author $author) {
                return [
                    'codigo' => $author->getId(),
                    'nome' => $author->getName(),

                ];
            }, $this->authors)
        ];
    }
}